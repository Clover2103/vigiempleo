<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $nombre       = $_POST["nombre_empresa_pn"];
    $cargo        = $_POST["cargo_pn"];
    $ingreso      = $_POST["tiempo_ingreso_exp_pn"];
    $auntrabaja   = $_POST["y_work_pn"];
    $tipo_cargo   = $_POST["tip_car_1"];
    $salida       = $_POST["tiempo_salida_1_pn"];
    $jefe         = $_POST["jefe_inmediato_pn"];
    $telefono     = $_POST["celular_exp_pn"];
    $tipo         = $_POST["val_exp_lab_1"];

    if(isset($_FILES['comp_rl_pn']) && $_FILES['comp_rl_pn']['error'] === UPLOAD_ERR_OK){

        $targetDir = "../../documents/ref_lab/$usuario/";

        // Crear la carpeta si no existe
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['comp_rl_pn']["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = $usuario . '-doc.' . $extension;
        $add = $targetDir . $file_name;
        $targetRefLab1 = "../documents/ref_lab/$usuario/$file_name";

        // Consulta la ruta del documento actual del usuario
        $query = "SELECT comp_lab FROM ref_laboral WHERE id_ref_lab = :tipo";
        $stmt = $conexion->prepare($query);
        $stmt->execute([':tipo' => $tipo]);

        // Elimina el documento actual si existe
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $doc_actual = "../../" . $row['comp_lab'];
            if (!empty($doc_actual) && file_exists($doc_actual)) {
                unlink($doc_actual);
            }
        }

        // Sube el nuevo archivo
        if (move_uploaded_file($_FILES['comp_rl_pn']["tmp_name"], $add)) {
            try {
                $query = "UPDATE ref_laboral SET nom_empresa = :nombre, cod_cargo = :tipo_cargo, cargo = :cargo, tie_ingreso = :ingreso, sig_trab = :auntrabaja, tie_salida = :salida, jefe_inmediato = :jefe, tele_jefe = :telefono, comp_lab = :ruta
                        WHERE numero_doc = :usuario AND id_ref_lab = :tipo";
                $stmt = $conexion->prepare($query);
                $stmt->execute([
                    ':nombre' => $nombre,
                    ':tipo_cargo' => $tipo_cargo,
                    ':cargo' => $cargo,
                    ':ingreso' => $ingreso,
                    ':auntrabaja' => $auntrabaja,
                    ':salida' => $salida,
                    ':jefe' => $jefe,
                    ':telefono' => $telefono,
                    ':ruta' => $targetRefLab1,
                    ':usuario' => $usuario,
                    ':tipo' => $tipo
                ]);
                $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
            } catch (PDOException $e) {
                $cont['error'] =  'Surgió un error de modificación: ' . $e->getMessage();
            }
        } else {
            $cont['error'] = 'No se pudo mover el archivo';
        }
    } else {

        try {
            $query = "UPDATE ref_laboral SET nom_empresa = :nombre, cod_cargo = :tipo_cargo, cargo = :cargo, tie_ingreso = :ingreso, sig_trab = :auntrabaja, tie_salida = :salida, jefe_inmediato = :jefe, tele_jefe = :telefono
                    WHERE numero_doc = :usuario AND id_ref_lab = :tipo";
            $stmt = $conexion->prepare($query);
            $stmt->execute([
                ':nombre' => $nombre,
                ':tipo_cargo' => $tipo_cargo,
                ':cargo' => $cargo,
                ':ingreso' => $ingreso,
                ':auntrabaja' => $auntrabaja,
                ':salida' => $salida,
                ':jefe' => $jefe,
                ':telefono' => $telefono,
                ':usuario' => $usuario,
                ':tipo' => $tipo
            ]);
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
        } catch (PDOException $e) {
            $cont['error'] =  'Surgió un error de modificación: ' . $e->getMessage();
        }

    }

    echo json_encode($cont);
}

?>
