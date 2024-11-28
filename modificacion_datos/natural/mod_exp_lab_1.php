<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $nombre             = $_POST["nombre"];
    $cargo              = $_POST["cargo"];
    $ingreso            = $_POST["ingreso"];
    $salida             = $_POST["salida"];
    $jefe               = $_POST["jefe"];
    $telefono           = $_POST["telefono"];
    $tipo               = $_POST["tipo"];

    try {
        $query = "UPDATE
                ref_laboral
            SET
                nom_empresa         = '$nombre',
                cargo               = '$cargo',   
                tie_ingreso         = '$ingreso',
                tie_salida          = '$salida',
                jefe_inmediato      = '$jefe',
                tele_jefe         = '$telefono'
            WHERE 
                numero_doc = '$usuario' AND id_ref_lab = '$tipo'";
        $insert = $conexion->prepare("$query");
        $insert->execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}

?>