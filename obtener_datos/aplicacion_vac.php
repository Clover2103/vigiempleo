<?php
session_start();
$cont = [];
include_once("../conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto -> conexionBD();

// Verificar si el usuario tiene una sesión abierta
if (isset($_SESSION["num_doc"])) {
    try {
        $usuario = $_SESSION["num_doc"];
        $id_vac = $_POST["id_vac"];
        $id_emp = $_POST["id_emp"];

        $query = "INSERT INTO natural_vacante (id_vacante, numero_doc, id_empresa)
            VALUES (:id_vac, :user_n, :id_emp)";
        $insert = $conexion->prepare("$query");
        $insert->bindParam(':user_n', $usuario, PDO::PARAM_STR);
        $insert->bindParam(':id_vac', $id_vac, PDO::PARAM_STR);
        $insert->bindParam(':id_emp', $id_emp, PDO::PARAM_STR);
        $insert->execute();
        $cont['okay'] = 'Aplicado correctamente a vacante';
    } catch (PDOException $e) {
        $cont['error'] = 'Ya se encuentra una aplicacion suya a esta vacante';
    }
} else {
    $cont['error'] = 'Para aplicar, debe iniciar sesión';
}
echo json_encode($cont);
?>
