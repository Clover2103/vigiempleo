<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $user = $_SESSION["num_doc"];

    $user = $_SESSION["num_doc"];

    $nombre_empresa =       $_POST['nombre'];
    $cargo =                $_POST['cargo'];
    $tiempo_ingreso_exp =   $_POST['ingreso'];
    $tiempo_salida_1 =      $_POST['salida'];
    $jefe_inmediato =       $_POST['jefe'];
    $celular_exp =          $_POST['telefono'];

    try {
        $query =("INSERT INTO ref_laboral (numero_doc,nom_empresa,cargo	,tie_ingreso,tie_salida,jefe_inmediato,tele_jefe)
            VALUES (:num_doc,:nom_emp_2,:cargo_2,:tie_ing_exp_2,:tie_sali_exp_2,:jefe_2,:tel_jefe_2)");
        $insert = $conexion->prepare("$query");
        $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
        $insert -> bindParam(':nom_emp_2',$nombre_empresa,PDO::PARAM_STR);
        $insert -> bindParam(':cargo_2',$cargo,PDO::PARAM_STR);
        $insert -> bindParam(':tie_ing_exp_2',$tiempo_ingreso_exp,PDO::PARAM_STR);
        $insert -> bindParam(':tie_sali_exp_2',$tiempo_salida_1,PDO::PARAM_STR);
        $insert -> bindParam(':jefe_2',$jefe_inmediato,PDO::PARAM_STR);
        $insert -> bindParam(':tel_jefe_2',$celular_exp,PDO::PARAM_STR);
        $insert->execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}
?>