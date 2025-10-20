<?php

    $cont = [];
    if (!isset($_POST["id_user"]) && !isset($_POST["cont_user"])) {
        $cont['error'] = 'Uno de los campos requeridos esta incompleto o vacio';
    } else {
        include_once("../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto -> conexionBD();

        // Informacion de tabla usuario empresa
        $id_user =                  $_POST["id_user"];
        $cont_user =                $_POST["cont_user"];
        $inp_rec_cred =             $_POST["inp_rec_cred"];

        try {
            
            $query = "SELECT * FROM usuario_admin WHERE usuario_admin = '$id_user' AND contrasena = '$cont_user'";
            $insert = $conexion->prepare($query);
            $insert->execute();
            $inf_query = $insert->fetch(PDO::FETCH_ASSOC);
            if ($insert->rowCount() == 1 ) {
                session_start();
                // Variables de sesion usuario natural
                $url = "../admin/inicio_admin.php";
                $_SESSION["nombre"]         = $inf_query ["nombre"];
                $_SESSION['time']           = time();
                $_SESSION['minutos']        = 1800;
                
                if ($inp_rec_cred == "true") {
                    $_SESSION["rec_cred"]        = true;
                } else {
                    $_SESSION["rec_cred"]        = false;
                }
                // Validacion de de ingreso correcto en base de datos
                if ($insert->rowCount() == 1) {
                    $cont['okay'] = "V";
                    $cont['url'] = $url;
                }
            } else {
                $cont['error'] = 'Error de usuario: Numero de usuario o contraseña invalidos';
            }
        } catch (PDOException $e) {
            $cont['error'] = 'Error de usuario '. $usuario .' No se encuentra registrado';
        }
        echo json_encode($cont);
    }
?>