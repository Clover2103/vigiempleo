<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $user = $_SESSION["num_doc"];

    $nombre_instituto =          $_POST['nom_insti'];
    $nivel_academico =           $_POST['nivel_aca'];
    $titulo_op =                 $_POST['titulo'];
    $tiempo_fin_1 =              $_POST['finalizacion'];

    try {
        $query =("INSERT INTO estudios (numero_doc,nom_insti,nivel_aca,titulo,fec_fin)
            VALUES (:num_doc,:nom_ins,:niv_aca,:titulo,:fec_fin)");
        $insert = $conexion->prepare("$query");
        $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
        $insert -> bindParam(':nom_ins',$nombre_instituto,PDO::PARAM_STR);
        $insert -> bindParam(':niv_aca',$nivel_academico,PDO::PARAM_STR);
        $insert -> bindParam(':titulo',$titulo_op,PDO::PARAM_STR);
        $insert -> bindParam(':fec_fin',$tiempo_fin_1,PDO::PARAM_STR);
        $insert -> execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}
?>