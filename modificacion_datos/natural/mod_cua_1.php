<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $lugar                  = $_POST["lug_cuali_pn"];
    $nom_cualifi            = $_POST["lug_cualifica_pn"];
    $fec_cualifi            = $_POST["fech_cualifi_pn"];
    $tipo                   = $_POST["val_cua_1"];

    $targetDir = "../../documents/cualificaciones/$usuario/";

    $targetCua1 = '';

    if(isset($_FILES['doc_cualifi_pn']["name"])){
        $file_name = $_FILES['doc_cualifi_pn']["name"];
        $extension = pathinfo($_FILES['doc_cualifi_pn']["name"],PATHINFO_EXTENSION);
        $file_name = $usuario.'-'.'doc'.'.'.$extension;
        $add = $targetDir . $file_name;
        $targetCua1 = "../documents/cualificaciones/$usuario/$file_name";

        // Consulta la ruta de la foto actual del usuario
        $query = "SELECT doc_cualifi FROM cualificaciones WHERE numero_doc = '$usuario'";
        $result = $conexion->query($query);
        if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doc_actual = $row['doc_cualifi'];
            // Elimina la foto actual si existe
            if (!empty($doc_actual) && file_exists($doc_actual)) {
                unlink($doc_actual);
            }
        }

        if (move_uploaded_file($_FILES['doc_cualifi_pn']["tmp_name"], $add)) {
            // Actualiza la ruta de la nueva foto en la base de datos
            try {
                $query = "UPDATE
                    cualificaciones
                SET
                    lugar               = '$lugar',
                    nom_cualifi         = '$nom_cualifi',   
                    fec_cualifi         = '$fec_cualifi',
                    doc_cualifi         = '$targetCua1'
                WHERE 
                    numero_doc = '$usuario' AND id_cualifi = '$tipo'";
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
                cualificaciones
            SET
                lugar               = '$lugar',
                nom_cualifi         = '$nom_cualifi',   
                fec_cualifi         = '$fec_cualifi'
            WHERE 
                numero_doc = '$usuario' AND id_cualifi = '$tipo'";
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