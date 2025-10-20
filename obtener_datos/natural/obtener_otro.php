<?php
    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $usuario = isset($_GET["usuario"]) ? $_GET["usuario"] : $_SESSION["num_doc"];

    $query = "SELECT * FROM otro_estudios WHERE numero_doc = '$usuario'";
    $insert=$conexion->prepare($query);// BUSCAR REFERENCIA LABORAL
    $insert->execute();

    $json = array();

    while ($info = $insert->fetch(PDO::FETCH_ASSOC)){
        $json[] = array(
            'nom_ins'       => $info['nivel_ins_otro'],
            'titulo'        => $info['titulo_otro'],
            'fec_otro'      => $info['fec_fin_otro'],
            'comp_otro'     => $info['comp_otro']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>