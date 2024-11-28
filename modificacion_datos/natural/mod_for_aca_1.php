<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $nom_insti              = $_POST["nom_insti"];
    $nivel_aca              = $_POST["nivel_aca"];
    $titulo                 = $_POST["titulo"];
    $finalizacion           = $_POST["finalizacion"];
    $tipo                   = $_POST["tipo"];

    try {
        $query = "UPDATE
                estudios
            SET
                nom_insti           = '$nom_insti',
                nivel_aca           = '$nivel_aca',   
                titulo              = '$titulo',
                fec_fin             = '$finalizacion'
            WHERE 
                numero_doc = '$usuario' AND id_estu = '$tipo'";
        $insert = $conexion->prepare("$query");
        $insert->execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}

?>