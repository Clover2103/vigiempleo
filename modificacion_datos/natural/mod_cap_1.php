<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $lugar                  = $_POST["lug_capaci_pn"];
    $nom_capa               = $_POST["lug_capacita_pn"];
    $fec_capa               = $_POST["fech_capacita_pn"];
    $tipo                   = $_POST["val_cap_1_pn"];

    $targetDir = "../../documents/capacitaciones/$usuario/";

    $targetCua1 = '';

    if(isset($_FILES['doc_capacita_pn']["name"])){
        $file_name = $_FILES['doc_capacita_pn']["name"];
        $extension = pathinfo($_FILES['doc_capacita_pn']["name"],PATHINFO_EXTENSION);
        $file_name = $usuario.'-'.'doc'.'.'.$extension;
        $add = $targetDir . $file_name;
        $targetCap1 = "../documents/capacitaciones/$usuario/$file_name";

        // Consulta la ruta de la foto actual del usuario
        $query = "SELECT doc_cuapa FROM capacitaciones WHERE numero_doc = '$usuario'";
        $result = $conexion->query($query);
        if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doc_actual = $row['doc_cuapa'];
            // Elimina la foto actual si existe
            if (!empty($doc_actual) && file_exists($doc_actual)) {
                unlink($doc_actual);
            }
        }

        if (move_uploaded_file($_FILES['doc_capacita_pn']["tmp_name"], $add)) {
            // Actualiza la ruta de la nueva foto en la base de datos
            try {
                $query = "UPDATE
                    capacitaciones
                SET
                    lugar             = '$lugar',
                    nom_cuapa         = '$nom_capa',   
                    fec_cuapa         = '$fec_capa',
                    doc_cuapa         = '$targetCap1'
                WHERE 
                    numero_doc = '$usuario' AND id_cuapa = '$tipo'";
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
                capacitaciones
            SET
                    lugar             = '$lugar',
                    nom_cuapa         = '$nom_capa',   
                    fec_cuapa         = '$fec_capa'
            WHERE 
                numero_doc = '$usuario' AND id_cuapa = '$tipo'";
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