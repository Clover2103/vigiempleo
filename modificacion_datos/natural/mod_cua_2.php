<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto->conexionBD();
    session_start();

    $query = "SELECT * FROM ciclo_cualificacion";
    $smtm = $conexion->prepare($query);
    $smtm->execute();
    $inf_cu = $smtm->fetchAll(PDO::FETCH_OBJ);

    $usuario        = $_SESSION["num_doc"];

    $lugar          = $_POST["lug_cuali_2_pn"];
    $nom_cualifi    = $_POST["lug_cualifica_2_pn"];
    $nombre_cuali                = "";
    foreach ($inf_cu as $registro) {
        if ($registro->cod_cuali == $nom_cualifi) {
            $nombre_cuali = $registro->cualificacion;
            break;
        }
    }
    $fec_cualifi    = $_POST["fech_cualifi_2_pn"];
    $tipo           = $_POST["val_cua_2"];

    if (isset($_FILES['doc_cualifi_2_pn']) && $_FILES['doc_cualifi_2_pn']["error"] === 0) {

        $targetDir = "../../documents/cualificaciones/$usuario/";

        // Crear carpeta si no existe
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['doc_cualifi_2_pn']["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = $usuario . '-doc2.' . $extension;
        $add = $targetDir . $file_name;
        $targetCua2 = "../documents/cualificaciones/$usuario/$file_name";

        // Consulta la ruta del documento actual del usuario
        $query = "SELECT doc_cualifi FROM cualificaciones WHERE id_cualifi = :id_cualifi";
        $stmt = $conexion->prepare($query);
        $stmt->execute([":id_cualifi" => $tipo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Elimina el documento actual si existe
        if ($row) {
            $doc_actual = $row['doc_cualifi'];
            if (!empty($doc_actual) && file_exists($doc_actual)) {
                unlink($doc_actual);
            }
        }

        // Sube el nuevo archivo
        if (move_uploaded_file($_FILES['doc_cualifi_2_pn']["tmp_name"], $add)) {

            try {
                $query = "UPDATE cualificaciones SET lugar = :lugar, cod_cuali = :nom_cualifi, nom_cualifi = :nombre_cuali, fec_cualifi = :fec_cualifi, doc_cualifi = :doc_cualifi
                    WHERE numero_doc = :numero_doc AND id_cualifi = :id_cualifi";
                $update = $conexion->prepare($query);
                $update->execute([
                    ":lugar" => $lugar,
                    ":nom_cualifi" => $nom_cualifi,
                    ":nombre_cuali" => $nombre_cuali,
                    ":fec_cualifi" => $fec_cualifi,
                    ":doc_cualifi" => $targetCua2,
                    ":numero_doc" => $usuario,
                    ":id_cualifi" => $tipo
                ]);
                $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';
            } catch (PDOException $e) {
                $cont['error'] = 'Surgió un error de modificación: ' . $e->getMessage();
            }

        } else {
            $cont['error'] = 'No se pudo guardar el nuevo documento.';
        }

        echo json_encode($cont);

    } else {
        try {
            $query = "UPDATE cualificaciones SET lugar = :lugar, cod_cuali = :nom_cualifi, nom_cualifi = :nombre_cuali, fec_cualifi = :fec_cualifi
                WHERE numero_doc = :numero_doc AND id_cualifi = :id_cualifi";
            $update = $conexion->prepare($query);
            $update->execute([
                ":lugar" => $lugar,
                ":nom_cualifi" => $nom_cualifi,
                ":nombre_cuali" => $nombre_cuali,
                ":fec_cualifi" => $fec_cualifi,
                ":numero_doc" => $usuario,
                ":id_cualifi" => $tipo
            ]);
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';
        } catch (PDOException $e) {
            $cont['error'] = 'Surgió un error de modificación: ' . $e->getMessage();
        }
    }

    echo json_encode($cont);
}
?>
