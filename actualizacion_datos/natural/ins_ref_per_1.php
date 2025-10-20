<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $user = $_SESSION["num_doc"];

    $nomb_ref                 = $_POST["nombre"];
    $ape_ref                  = $_POST["apellido"];
    $cel_ref                  = $_POST["cargo"];
    $car_ref                  = $_POST["telefono"];

    try {
        $query ="INSERT INTO ref_personal (numero_doc,nom_ref_per,ape_ref_per,telefono_ref,cargo)
            VALUES (:num_doc,:nom_ref_2,:ape_ref_2,:cel_ref_2,:car_ref_2)";
        $insert = $conexion->prepare("$query");
        $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
        $insert -> bindParam(':nom_ref_2',$nomb_ref,PDO::PARAM_STR);
        $insert -> bindParam(':ape_ref_2',$ape_ref,PDO::PARAM_STR);
        $insert -> bindParam(':cel_ref_2',$cel_ref,PDO::PARAM_STR);
        $insert -> bindParam(':car_ref_2',$car_ref,PDO::PARAM_STR);
        $insert->execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}
?>