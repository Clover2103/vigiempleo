<?php
  header('Content-Type: application/json');
  include_once("../../conexion-PDO.php");

  $objeto = new Cconexion();
  $conexion = $objeto->conexionBD();

  $cedula = $_POST['cedula'] ?? '';

  if($cedula === ''){
      echo json_encode(["error" => "No se recibió número de documento"]);
      exit;
  }

  try {
      // Preparamos la consulta con PDO
      $stmt = $conexion->prepare("SELECT * FROM usuario_natural WHERE numero_doc = :cedula");
      $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
      $stmt->execute();

      if($stmt->rowCount() > 0){
          echo json_encode(["existe" => true]); // Ya registrado
      } else {
          echo json_encode(["existe" => false]); // Disponible
      }

  } catch (PDOException $e) {
      echo json_encode(["error" => "Error en la consulta: " . $e->getMessage()]);
  }
?>
