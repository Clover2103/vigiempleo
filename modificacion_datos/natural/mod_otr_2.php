<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto->conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $nom_inst   = $_POST["nom_inst_otro_2_pn"];
    $titulo     = $_POST["tit_op_otro_2_pn"];
    $tiempo     = $_POST["tie_fin_otro_2_pn"];
    $tipo       = $_POST["val_otro_2_pn"];

    if (isset($_FILES['doc_otro_2_pn']) && $_FILES['doc_otro_2_pn']["error"] === 0) {

        $targetDir = "../../documents/otros/$usuario/";

        // Crear carpeta si no existe
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['doc_otro_2_pn']["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = $usuario . '-otro2.' . $extension;
        $add = $targetDir . $file_name;
        $targetArchivo = "../documents/otros/$usuario/$file_name";

        // Consulta la ruta del documento actual del usuario
        $query = "SELECT doc_otro FROM otros WHERE id_estu_otro = :tipo";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();

        // Elimina el documento actual si existe
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $doc_actual = $row['doc_otro'];
            $ruta_doc_actual = "../../" . $doc_actual;
            if (!empty($doc_actual) && file_exists($ruta_doc_actual)) {
                unlink($ruta_doc_actual);
            }
        }

        // Sube el nuevo archivo
        if (move_uploaded_file($_FILES['doc_otro_2_pn']["tmp_name"], $add)) {

            try {
                $query = "UPDATE otros SET nom_inst = :nom_inst, tit_obtenido = :titulo, tiempo_fin = :tiempo, competencia = :competencia, doc_otro = :doc
                    WHERE numero_doc = :usuario AND id_estu_otro = :tipo";
                $update = $conexion->prepare($query);
                $update->bindParam(':nom_inst', $nom_inst);
                $update->bindParam(':titulo', $titulo);
                $update->bindParam(':tiempo', $tiempo);
                $update->bindParam(':competencia', $competencia);
                $update->bindParam(':doc', $targetArchivo);
                $update->bindParam(':usuario', $usuario);
                $update->bindParam(':tipo', $tipo);
                $update->execute();
                $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
            } catch (PDOException $e) {
                $cont['error'] = 'Surgió un error de modificación: ' . $e->getMessage();
            }

            echo json_encode($cont);

        }
    } else {

        try {
            $query = "UPDATE otros SET nom_inst = :nom_inst, tit_obtenido = :titulo, tiempo_fin = :tiempo
                WHERE numero_doc = :usuario AND id_estu_otro = :tipo";
            $update = $conexion->prepare($query);
            $update->bindParam(':nom_inst', $nom_inst);
            $update->bindParam(':titulo', $titulo);
            $update->bindParam(':tiempo', $tiempo);
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
