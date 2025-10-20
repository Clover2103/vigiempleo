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
    }

    $rutafoto1 = '';

    if(isset($_FILES['archivo_foto_emp']["name"])){
        $file_name = $_FILES['archivo_foto_emp']["name"];
        $extension = pathinfo($_FILES['archivo_foto_emp']["name"],PATHINFO_EXTENSION);
        $file_name = $user.'-'.'foto'.'.'.$extension;
        $add = $targetDir . $file_name;
        $rutafoto1 = "../../img/rgs_user_emp/$user/$file_name";

        // Consulta la ruta de la foto actual del usuario
        $query = "SELECT foto FROM usuario_empresa WHERE id_empresa = '$user'";
        $result = $conexion->query($query);
        if ($result && $row = $result->fetch(PDO::FETCH_ASSOC)) {
            $foto_actual = $row['foto'];
            if (!empty($foto_actual) && file_exists($foto_actual)) {
                unlink($foto_actual);
            }
        }

        if (move_uploaded_file($_FILES['archivo_foto_emp']["tmp_name"], $add)) {
            try {
                $query = "UPDATE usuario_empresa SET foto = '$rutafoto1' WHERE id_empresa = '$user'";
                $update = $conexion->prepare($query);
                $update->execute();
                $_SESSION["fot_emp"] = $rutafoto1;
                $cont['mensaje'] = "Se realizaron las modificaciones correspondientes";
            } catch (PDOException $e) {
                $cont['error'] = "Surgió un error" . $e->getMessage();
            }
            echo json_encode($cont);
        }
    }
}

?>