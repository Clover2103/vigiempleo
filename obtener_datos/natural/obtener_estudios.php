<?php
    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $usuario = isset($_GET["usuario"]) ? $_GET["usuario"] : $_SESSION["num_doc"];

    $query = "SELECT * FROM estudios WHERE numero_doc = '$usuario'";
    $insert=$conexion->prepare($query);// BUSCAR REFERENCIA LABORAL
    $insert->execute();

    $json = array();

    while ($info = $insert->fetch(PDO::FETCH_ASSOC)){
        $json[] = array(
            'nom_ins'   => $info['nom_insti'],
            'niv_aca'   => $info['nivel_aca'],
            'titulo'    => $info['titulo'],
            'sig_estu'  => $info['sig_estu'],
            'culmino'   => $info['culmino'],
            'fec_fin'   => $info['fec_fin'],
            'comp_est'  => $info['comp_est']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>