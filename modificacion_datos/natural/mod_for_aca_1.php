<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto->conexionBD();
    session_start();

    $query = "SELECT * FROM nivel_academico";
    $smtm = $conexion->prepare($query);
    $smtm->execute();
    $inf_na = $smtm->fetchAll(PDO::FETCH_OBJ);

    $usuario = $_SESSION["num_doc"];

    $nom_insti      = $_POST["nombre_instituto_pn"];
    $nivel_aca      = $_POST["nivel_academico_pn"];
    $nivel          = "";
    foreach ($inf_na as $registro) {
        if ($registro->cod_na == $nivel_aca) {
            $nivel = $registro->nivel_academico;
            break;
        }
    }
    $titulo         = $_POST["titulo_op_pn"];
    $culmino        = $_POST["y_stu_pn"];
    $sig_estu       = $culmino === "si" ? 1 : 0;
    $finalizacion   = $_POST["tiempo_fin_1_pn"];
    $tipo           = $_POST["val_1"];

    if (isset($_FILES['comp_stu_pn']) && $_FILES['comp_stu_pn']['error'] === UPLOAD_ERR_OK) {
        
        $targetDir  = "../../documents/est_for/$usuario/";

        // Crear carpeta si no existe
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['comp_stu_pn']["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = $usuario . '-est_for.' . $extension;
        $add = $targetDir . $file_name;
        $targetStudy = "../documents/est_for/$usuario/$file_name";

        /// Consulta la ruta del documento actual del usuario
        $query = "SELECT comp_est FROM estudios WHERE id_estu = '$tipo'";
        $result = $conexion->query($query);

        // Elimina el documento actual si existe
        if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doc_actual = $row['comp_est'];
            if (!empty($doc_actual) && file_exists($doc_actual)) {
                unlink($doc_actual);
            }
        }

        // Sube el nuevo archivo
        if (move_uploaded_file($_FILES['comp_stu_pn']["tmp_name"], $add)) {

            try {
                $query = "UPDATE estudios SET nom_insti = :nom_insti, cod_na = :nivel_aca, nivel_aca = :nivel, titulo = :titulo, culmino = :culmino, sig_estu = :sig_estu, fec_fin = :fec_fin, comp_est = :comp_estu
                    WHERE numero_doc = :numero_doc AND id_estu = :id_estu";
                $update = $conexion->prepare($query);
                $update->execute([
                    ":nom_insti" => $nom_insti,
                    ":nivel_aca" => $nivel_aca,
                    ":nivel" => $nivel,
                    ":titulo" => $titulo,
                    ":culmino" => $culmino,
                    ":sig_estu" => $sig_estu,
                    ":fec_fin" => $finalizacion,
                    ":comp_estu" => $targetStudy,
                    ":numero_doc" => $usuario,
                    ":id_estu" => $tipo
                ]);
                $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';
            } catch (PDOException $e) {
                $cont['error'] = 'Surgió un error de modificación: ' . $e->getMessage();
            }
        } else {
            $cont['error'] = 'No se pudo guardar el nuevo documento.';
        }
    } else {
        try {
            $query = "UPDATE estudios SET nom_insti = :nom_insti, cod_na = :nivel_aca, nivel_aca = :nivel, titulo = :titulo, culmino = :culmino, sig_estu = :sig_estu, fec_fin = :fec_fin
                WHERE numero_doc = :numero_doc AND id_estu = :id_estu";
            $update = $conexion->prepare($query);
            $update->execute([
                ":nom_insti" => $nom_insti,
                ":nivel_aca" => $nivel_aca,
                ":nivel" => $nivel,
                ":titulo" => $titulo,
                ":culmino" => $culmino,
                ":sig_estu" => $sig_estu,
                ":fec_fin" => $finalizacion,
                ":numero_doc" => $usuario,
                ":id_estu" => $tipo
            ]);
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';
        } catch (PDOException $e) {
            $cont['error'] = 'Surgió un error de modificación: ' . $e->getMessage();
        }
    }

    echo json_encode($cont);
}
?>
