<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto->conexionBD();
    session_start();

    $user = $_SESSION["id_empr"];

    $targetDir = "../../img/rgs_user_emp/$user/";

    if (!file_exists($targetDir)){
        mkdir($targetDir,0755,true); 
        echo("Entre aqui pues papa foto");
    }

    $rutafoto1 = '';

    if(isset($_FILES['archivo_logo']["name"])){
        $file_name = $_FILES['archivo_logo']["name"];
        $extension = pathinfo($_FILES['archivo_logo']["name"],PATHINFO_EXTENSION);
        $file_name = $user.'-'.'logo'.'.'.$extension;
        $add = $targetDir . $file_name;
        $rutafoto1 = "../../img/rgs_user_emp/$user/$file_name";

        $query = "SELECT logo_empresa FROM usuario_empresa WHERE id_empresa = '$user'";
        $result = $conexion->query($query);
        if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
            $foto_actual = $row['logo_empresa'];
            if (!empty($foto_actual) && file_exists($foto_actual)) {
                unlink($foto_actual);
            }
        }

        if (move_uploaded_file($_FILES['archivo_logo']["tmp_name"], $add)) {
            try {
                $query = "UPDATE usuario_empresa SET logo_empresa = '$rutafoto1' WHERE id_empresa = '$user'";
                $update = $conexion->prepare($query);
                $update->execute();
                $_SESSION["log_emp"] = $rutafoto1;
                $cont['mensaje'] = "Se realizaron las modificaciones correspondientes";
            } catch (PDOException $e) {
                $cont['error'] = "Surgió un error" . $e->getMessage();
            }
            echo json_encode($cont);
        }
    }
}

?>