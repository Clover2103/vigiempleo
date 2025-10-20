<?php
    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $usuario = isset($_GET["usuario"]) ? $_GET["usuario"] : $_SESSION["num_doc"];

    $query = "SELECT * FROM capacitaciones WHERE numero_doc = '$usuario'";
    $insert=$conexion->prepare($query);// BUSCAR REFERENCIA LABORAL
    $insert->execute();

    $json = array();

    while ($info = $insert->fetch(PDO::FETCH_ASSOC)){
        $json[] = array(
            'nom_ins'   => $info['lugar'],
            'nom_cap'   => $info['nom_cuapa'],
            'fec_cap'   => $info['fec_cuapa'],
            'doc_cap'   => $info['doc_cuapa']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>