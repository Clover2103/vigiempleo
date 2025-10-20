<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $query = "SELECT * FROM ciclo_capacitacion";
    $smtm = $conexion->prepare($query);
    $smtm->execute();
    $inf_cc = $smtm->fetchAll(PDO::FETCH_OBJ);

    $usuario = $_SESSION["num_doc"];

    $lugar      = $_POST["lug_capaci_2_pn"];
    $nom_capa   = $_POST["lug_capacita_2_pn"];
    $nombre_capacitacion          = "";
    foreach ($inf_cc as $registro) {
        if ($registro->cod_cap == $nom_capa) {
            $nombre_capacitacion = $registro->capacitacion;
            break;
        }
    }
    $fec_capa   = $_POST["fech_capacita_2_pn"];
    $tipo       = $_POST["val_cap_2_pn"];

    if (isset($_FILES['doc_capacita_2_pn']) && $_FILES['doc_capacita_2_pn']["error"] === 0) {
        
        $targetDir = "../../documents/capacitaciones/$usuario/";
        
        // Crear carpeta si no existe
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['doc_capacita_2_pn']["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = $usuario . '-doc2.' . $extension;
        $add = $targetDir . $file_name;
        $targetCap1 = "../documents/capacitaciones/$usuario/$file_name";

        // Consulta la ruta del documento actual del usuario
        $query = "SELECT doc_cuapa FROM capacitaciones WHERE id_cuapa = :tipo";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();

        // Elimina el documento actual si existe
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $doc_actual = $row['doc_cuapa'];
            $ruta_doc_actual = "../../" . $doc_actual;
            if (!empty($doc_actual) && file_exists($ruta_doc_actual)) {
                unlink($ruta_doc_actual);
            }
        }

        // Sube el nuevo archivo
        if (move_uploaded_file($_FILES['doc_capacita_2_pn']["tmp_name"], $add)) {

            try {
                $query = "UPDATE capacitaciones SET lugar = :lugar, cod_cap = :nom_capa, nom_cuapa = :nom_capacita, fec_cuapa = :fec_capa, doc_cuapa = :doc
                    WHERE numero_doc = :usuario AND id_cuapa = :tipo";
                $update = $conexion->prepare($query);
                $update->bindParam(':lugar', $lugar);
                $update->bindParam(':nom_capa', $nom_capa);
                $update->bindParam(':nom_capacita', $nombre_capacitacion);
                $update->bindParam(':fec_capa', $fec_capa);
                $update->bindParam(':doc', $targetCap1);
                $update->bindParam(':usuario', $usuario);
                $update->bindParam(':tipo', $tipo);
                $update->execute();
                $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
            } catch (PDOException $e) {
                $cont['error'] = 'Surgió un error de modificación: ' . $e->getMessage();
            }

        } else {
            $cont['error'] = 'Error al subir el archivo.';
        }

        echo json_encode($cont);

    } else {

        try {
            $query = "UPDATE capacitaciones SET lugar = :lugar, cod_cap = :nom_capa, nom_cuapa = :nom_capacita, fec_cuapa = :fec_capa
                WHERE numero_doc = :usuario AND id_cuapa = :tipo";
            $update = $conexion->prepare($query);
            $update->bindParam(':lugar', $lugar);
            $update->bindParam(':nom_capa', $nom_capa);
            $update->bindParam(':nom_capacita', $nombre_capacitacion);
            $update->bindParam(':fec_capa', $fec_capa);
            $update->bindParam(':usuario', $usuario);
            $update->bindParam(':tipo', $tipo);
            $update->execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
        } catch (PDOException $e) {
            $cont['error'] = 'Surgió un error de modificación: ' . $e->getMessage();
        }

        echo json_encode($cont);

    }

}
?>