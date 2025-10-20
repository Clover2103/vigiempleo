<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto->conexionBD();
    session_start();

    $user = $_SESSION["id_empr"];

    $razon_social       = $_POST["razon_s"];
    $descripcion        = $_POST["descrip"];
    $mision_empresa     = $_POST["mision"];
    $vision_empresa     = $_POST["vision"];

    try {
        $query = "UPDATE 
                    usuario_empresa 
                SET 
                    razon_social    = :raz_soc,
                    descripcion     = :descrip,
                    mision          = :mis_emp,
                    vision          = :vis_emp
                WHERE 
                    id_empresa = :user";
        $insert = $conexion->prepare($query);
        $insert->bindParam(':raz_soc', $razon_social);
        $insert->bindParam(':descrip', $descripcion);
        $insert->bindParam(':mis_emp', $mision_empresa);
        $insert->bindParam(':vis_emp', $vision_empresa);
        $insert->bindParam(':user', $user);
        $insert->execute();

        if ($insert->rowCount() > 0) {
            $_SESSION["razon_s"]    = $razon_social;
            $_SESSION["des_emp"]    = $descripcion;
            $_SESSION["mision"]     = $mision_empresa;
            $_SESSION["vision"]     = $vision_empresa;
        } else {
            $cont['error'] = "Surgió un error";
        }
        $cont['mensaje'] = "Se realizaron las modificaciones correspondientes";
    } catch (PDOException $e) {
        $cont['error'] = "Surgió un error" . $e->getMessage();
    }
    echo json_encode($cont);
}
?>