<?php

$cont = [];
include_once ("../../conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto->conexionBD();
$numero = (isset($_POST['numeroDocumento'])) ? $_POST['numeroDocumento'] : '';

$query = "SELECT * FROM usuario_natural un WHERE un.numero_doc = :numero";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cont['mensaje'] = $info;
} else {
    $cont['error'] = 'No se encontraron resultados';
}

echo json_encode($cont);

?>
