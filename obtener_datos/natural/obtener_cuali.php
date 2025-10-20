<?php
    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $usuario = isset($_GET["usuario"]) ? $_GET["usuario"] : $_SESSION["num_doc"];

    $query = "SELECT * FROM cualificaciones WHERE numero_doc = '$usuario'";
    $insert=$conexion->prepare($query);// BUSCAR REFERENCIA LABORAL
    $insert->execute();

    $json = array();

    while ($info = $insert->fetch(PDO::FETCH_ASSOC)){
        $json[] = array(
            'lugar'     => $info['lugar'],
            'nom_cua'   => $info['nom_cualifi'],
            'fec_cua'   => $info['fec_cualifi'],
            'doc_cua'   => $info['doc_cualifi']
        );
    }    
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>