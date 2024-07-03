<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        session_start();
        $cont = [];
        include_once("../../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto->conexionBD();
        $id_vacante = $_POST['id_vacante'];

        $id_vacante = intval($id_vacante, 10);
        
        try {

            $query = "SELECT * FROM natural_vacante WHERE id_vacante = :id_vacante";
            $insert = $conexion->prepare($query);
            $insert->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
            $insert->execute();

            if ($insert->rowCount() > 0) {
                while ($inf_vac = $insert->fetch(PDO::FETCH_ASSOC)) {
                    $query = "DELETE FROM natural_vacante WHERE id_vacante = :id_vacante" ;
                    $deleteNaturalVacante = $conexion->prepare($query);
                    $deleteNaturalVacante->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
                    $deleteNaturalVacante->execute();
                }
            }

            $query = "SELECT * FROM vacante WHERE id_vacante = :id_vacante";
            $selectVacante = $conexion->prepare($query);
            $selectVacante->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
            $selectVacante->execute();

            if ($selectVacante->rowCount() > 0) {
                // Eliminar las filas relacionadas en natural_vacante
                $query = "DELETE FROM vacante WHERE id_vacante = :id_vacante";
                $deleteNaturalVacante = $conexion->prepare($query);
                $deleteNaturalVacante->bindParam(':id_vacante', $id_vacante, PDO::PARAM_INT);
                $deleteNaturalVacante->execute();

                $cont['mensaje'] = 'Se realizó correctamente la eliminación de la vacante';
            } else {
                $cont['error'] = 'La vacante no existe en la tabla vacante.';
            }
            $cont['mensaje'] = 'Se realizó correctamente la eliminación de la vacante';
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $conexion->rollBack();
            $cont['error'] = 'Surgió un error: ' . $e->getMessage();
        }
        echo json_encode($cont);
    }
?>
