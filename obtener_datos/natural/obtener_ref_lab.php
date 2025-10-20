<?php
    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $usuario = isset($_GET["usuario"]) ? $_GET["usuario"] : $_SESSION["num_doc"];

    $query = "SELECT * FROM ref_laboral WHERE numero_doc = '$usuario'";
    $insert=$conexion->prepare($query);// BUSCAR REFERENCIA LABORAL
    $insert->execute();

    $json = array();

    while ($info = $insert->fetch(PDO::FETCH_ASSOC)){
        $json[] = array(
            'nom_emp'   => $info['nom_empresa'],
            'cargo'     => $info['cargo'],
            'tie_ing'   => $info['tie_ingreso'],
            'sig_trab'  => $info['sig_trab'],
            'tie_sal'   => $info['tie_salida'],
            'jef_inm'   => $info['jefe_inmediato'],
            'tel_jef'   => $info['tele_jefe'],
            'comp_lab'   => $info['comp_lab']            
        );
    }
    
    echo json_encode($json);
?>

