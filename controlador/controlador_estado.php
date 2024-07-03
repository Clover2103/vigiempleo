<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["estado"])) {
            $cont = [];
            include_once("../conexion-PDO.php");
            $objeto = new Cconexion();
            $conexion = $objeto->conexionBD();
            session_start();
            $usuario = $_SESSION["num_doc"];
            $estado = $_POST["estado"];

            if ($estado == "true") {
                $estado = "trabajando"; // Corregido: asignar el valor correctamente
            } else {
                $estado = "desempleado"; // Corregido: asignar el valor correctamente
            }

            try {
                $query = "UPDATE usuario_natural SET estado = :nuevo_estado WHERE numero_doc = :usuario";
                $insert = $conexion->prepare($query);
                $insert->bindParam(":nuevo_estado", $estado, PDO::PARAM_STR);
                $insert->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                $insert->execute();
                $_SESSION["estado"]  = $estado;
                $cont['mensaje'] = 'Estado actualizado correctamente';
            } catch (PDOException $e) {
                $cont['error'] = 'Error al cambiar el estado del usuario';
            }
            echo json_encode($cont);
        } else {
            echo "Error: La variable 'estado' no se recibió en la solicitud POST.";
        }
    } else {
        echo "Error: Esta página solo acepta solicitudes POST.";
    }
?>
