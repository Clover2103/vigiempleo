<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $cont = [];

    // Conexión PDO
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto->conexionBD();

    // Sanitizar id_vacante
    $id_vacante = intval($_POST['id_vacante'] ?? 0);

    if ($id_vacante <= 0) {
        echo json_encode(['error' => 'ID de vacante inválido']);
        exit;
    }

    try {
        $conexion->beginTransaction();

        // 1. Verificar si hay registros en natural_vacante
        $checkNatural = $conexion->prepare("SELECT COUNT(*) FROM natural_vacante WHERE id_vacante = :id_vacante");
        $checkNatural->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
        $checkNatural->execute();
        $countNatural = $checkNatural->fetchColumn();

        if ($countNatural > 0) {
            $deleteNatural = $conexion->prepare("DELETE FROM natural_vacante WHERE id_vacante = :id_vacante");
            $deleteNatural->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
            $deleteNatural->execute();
        }

        // 2. Verificar si existe la vacante antes de eliminar
        $checkVacante = $conexion->prepare("SELECT COUNT(*) FROM vacante WHERE id_vacante = :id_vacante");
        $checkVacante->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
        $checkVacante->execute();
        $countVacante = $checkVacante->fetchColumn();

        if ($countVacante > 0) {
            $deleteVacante = $conexion->prepare("DELETE FROM vacante WHERE id_vacante = :id_vacante");
            $deleteVacante->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
            $deleteVacante->execute();
        }

        $conexion->commit();

        $cont['mensaje'] = "Eliminación completada. Registros eliminados: natural_vacante ($countNatural), vacante ($countVacante)";
    } catch (PDOException $e) {
        $conexion->rollBack();
        $cont['error'] = 'Surgió un error: ' . $e->getMessage();
    }

    echo json_encode($cont);
}
?>
