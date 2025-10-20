<?php

include_once("../conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto -> conexionBD();

$cod_dep = $_POST["departamento"];

$query = "SELECT * FROM municipio WHERE cod_dep = '$cod_dep'";
$insert = $conexion->prepare($query);
$insert->execute();

$json = array();

while ($insert_ob = $insert->fetch(PDO::FETCH_ASSOC)){
    $json[] = array(
        'cod_mun'       => $insert_ob['cod_mun'],
        'municipio'     => $insert_ob['municipio']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;

?>