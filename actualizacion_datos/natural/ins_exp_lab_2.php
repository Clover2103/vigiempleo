<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $nombre        = $_POST["nombre_empresa_2_pn"];
    $cargo         = $_POST["cargo_2_pn"];
    $ingreso       = $_POST["tiempo_ingreso_exp_2_pn"];
    $auntrabaja    = $_POST["y_work_2_pn"];
    $tipo_cargo    = $_POST["tip_car_2"];
    $salida        = $_POST["tiempo_salida_2_pn"];
    $jefe          = $_POST["jefe_inmediato_2_pn"];
    $telefono      = $_POST["celular_exp_2_pn"];

    if (isset($_FILES['comp_rl_2_pn']) && $_FILES['comp_rl_2_pn']['error'] === UPLOAD_ERR_OK) {

        $targetLab = "../../documents/ref_lab/$usuario/";

        // Crea el directorio si no existe
        if (!file_exists($targetLab)){
            mkdir($targetLab, 0755, true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['comp_rl_2_pn']["name"];
        $extension = pathinfo($_FILES['comp_rl_2_pn']["name"], PATHINFO_EXTENSION);
        $file_name = $usuario . '-ref_lab2.' . $extension;
        $add = $targetLab . $file_name;
        $rutaRefLab = "../documents/ref_lab/$usuario/$file_name";

        if (!move_uploaded_file($_FILES['comp_rl_2_pn']["tmp_name"], $add)) {
            $cont['error'] = 'No se pudo mover el archivo: ' . $_FILES['comp_rl_2_pn']['error'];
            echo json_encode($cont);
            exit;
        }

        try {
            $query =("INSERT INTO ref_laboral (numero_doc,nom_empresa,cargo,tie_ingreso,sig_trab,cod_cargo,tie_salida,jefe_inmediato,tele_jefe,comp_lab)
                VALUES (:num_doc,:nom_emp,:cargo,:tie_ing_exp,:auntrabaja,:tipo_cargo,:tie_sali_exp,:jefe,:tel_jefe,:comp_lab)");
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':num_doc',$usuario,PDO::PARAM_STR);
            $insert -> bindParam(':nom_emp',$nombre,PDO::PARAM_STR);
            $insert -> bindParam(':cargo',$cargo,PDO::PARAM_STR);
            $insert -> bindParam(':tie_ing_exp',$ingreso,PDO::PARAM_STR);
            $insert -> bindParam(':auntrabaja',$auntrabaja,PDO::PARAM_STR);
            $insert -> bindParam(':tipo_cargo',$tipo_cargo,PDO::PARAM_STR);
            $insert -> bindParam(':tie_sali_exp',$salida,PDO::PARAM_STR);
            $insert -> bindParam(':jefe',$jefe,PDO::PARAM_STR);
            $insert -> bindParam(':tel_jefe',$telefono,PDO::PARAM_STR);
            $insert -> bindParam(':comp_lab',$rutaRefLab,PDO::PARAM_STR);
            $insert->execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);

    } else {
        try {
            $query =("INSERT INTO ref_laboral (numero_doc,nom_empresa,cargo,tie_ingreso,sig_trab,cod_cargo,tie_salida,jefe_inmediato,tele_jefe)
                VALUES (:num_doc,:nom_emp,:cargo,:tie_ing_exp,:auntrabaja,:tipo_cargo,:tie_sali_exp,:jefe,:tel_jefe)");
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':num_doc',$usuario,PDO::PARAM_STR);
            $insert -> bindParam(':nom_emp',$nombre,PDO::PARAM_STR);
            $insert -> bindParam(':cargo',$cargo,PDO::PARAM_STR);
            $insert -> bindParam(':tie_ing_exp',$ingreso,PDO::PARAM_STR);
            $insert -> bindParam(':auntrabaja',$auntrabaja,PDO::PARAM_STR);
            $insert -> bindParam(':tipo_cargo',$tipo_cargo,PDO::PARAM_STR);
            $insert -> bindParam(':tie_sali_exp',$salida,PDO::PARAM_STR);
            $insert -> bindParam(':jefe',$jefe,PDO::PARAM_STR);
            $insert -> bindParam(':tel_jefe',$telefono,PDO::PARAM_STR);
            $insert->execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);
    }
}
?>