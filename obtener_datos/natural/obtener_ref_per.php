<?php
    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $usuario = isset($_GET["usuario"]) ? $_GET["usuario"] : $_SESSION["num_doc"];

    $query = "SELECT * FROM ref_personal WHERE numero_doc = '$usuario'";
    $insert=$conexion->prepare($query);// BUSCAR REFERENCIA LABORAL
    $insert->execute();

    $json = array();

    while ($info = $insert->fetch(PDO::FETCH_ASSOC)){
        $json[] = array(
            'nom_ref'   => $info['nom_ref_per'],
            'ape_ref'   => $info['ape_ref_per'],
            'tel_ref'   => $info['telefono_ref'],
            'cargo'     => $info['cargo']
        );
    }    
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>