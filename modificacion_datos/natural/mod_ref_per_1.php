<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $usuario = $_SESSION["num_doc"];

    $nombre             = $_POST["nombre"];
    $apellido           = $_POST["apellido"];
    $cargo              = $_POST["cargo"];
    $telefono           = $_POST["telefono"];
    $tipo               = $_POST["tipo"];

    try {
        $query = "UPDATE
                ref_personal
            SET
                nom_ref_per         = '$nombre',
                ape_ref_per         = '$apellido',   
                telefono_ref        = '$telefono',
                cargo               = '$cargo'                
            WHERE 
                numero_doc = '$usuario' AND id_ref_per = '$tipo'";
        $insert = $conexion->prepare("$query");
        $insert->execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);

}

?>