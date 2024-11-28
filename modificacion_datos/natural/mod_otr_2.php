<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $nom_inst                   = $_POST["nom_inst_otro_2_pn"];
    $tit_op                     = $_POST["tit_op_otro_2_pn"];
    $tie_fin                    = $_POST["tie_fin_otro_2_pn"];
    $tipo                       = $_POST["val_otro_2_pn"];

    $targetDir = "../../documents/otro/$usuario/";

    $targetOtro1 = '';

    if(isset($_FILES['comp_otro_2_pn']["name"])){
        $file_name = $_FILES['comp_otro_2_pn']["name"];
        $extension = pathinfo($_FILES['comp_otro_2_pn']["name"],PATHINFO_EXTENSION);
        $file_name = $usuario.'-'.'doc2'.'.'.$extension;
        $add = $targetDir . $file_name;
        $targetOtro1 = "../documents/otro/$usuario/$file_name";

        // Consulta la ruta de la foto actual del usuario
        $query = "SELECT comp_otro FROM otro_estudios WHERE numero_doc = '$usuario'";
        $result = $conexion->query($query);
        if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doc_actual = $row['comp_otro'];
            // Elimina la foto actual si existe
            if (!empty($doc_actual) && file_exists($doc_actual)) {
                unlink($doc_actual);
            }
        }

        if (move_uploaded_file($_FILES['comp_otro_2_pn']["tmp_name"], $add)) {
            // Actualiza la ruta de la nueva foto en la base de datos
            try {
                $query = "UPDATE
                    otro_estudios
                SET
                    nivel_ins_otro      = '$nom_inst',
                    titulo_otro         = '$tit_op',   
                    fec_fin_otro        = '$tie_fin',
                    comp_otro           = '$targetOtro1'
                WHERE 
                    numero_doc = '$usuario' AND id_estu_otro = '$tipo'";
                $update = $conexion->prepare($query);
                $update->execute();
                $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
            } catch (PDOException $e) {
                $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
            }
            echo json_encode($cont);
        }
    } else {
        try {
            $query = "UPDATE
                otro_estudios
            SET
                nivel_ins_otro          = '$nom_inst',
                titulo_otro             = '$tit_op',   
                fec_fin_otro            = '$tie_fin'
            WHERE 
                numero_doc = '$usuario' AND id_estu_otro = '$tipo'";
            $update = $conexion->prepare($query);
            $update->execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);
    }

}

?>