<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $user = $_SESSION["num_doc"];

    $targetDir = "../../img/rgs_user_nat/$user/";

    if (!file_exists($targetDir)){
        mkdir($targetDir,0755,true); 
        echo("Entre aqui pues papa foto");
    }

    $rutafoto1 = '';

    if(isset($_FILES['archivo_pn'])){
        $file_name = $_FILES['archivo_pn']["name"];
        $extension = pathinfo($_FILES['archivo_pn']["name"],PATHINFO_EXTENSION);
        $file_name = $user.'-'.'foto'.'.'.$extension;
        $add = $targetDir . $file_name;
        $rutafoto1 = "../img/rgs_user_nat/$user/$file_name";

        // Consulta la ruta de la foto actual del usuario
        $query = "SELECT foto FROM usuario_natural WHERE numero_doc = '$user'";
        $result = $conexion->query($query);
        if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
            $foto_actual = $row['foto'];
            // Elimina la foto actual si existe
            if (!empty($foto_actual) && file_exists($foto_actual)) {
                unlink($foto_actual);
            }
        }

        if (move_uploaded_file($_FILES['archivo_pn']["tmp_name"], $add)) {
            // Actualiza la ruta de la nueva foto en la base de datos
            try {
                $query = "UPDATE usuario_natural SET foto = '$rutafoto1' WHERE numero_doc = '$user'";
                $update = $conexion->prepare($query);
                $update->execute();  
                $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
            } catch (PDOException $e) {
                $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
            }
            echo json_encode($cont);
        }
    }
}

?>