<?php

    $cont = [];
    if (!isset($_POST["id_user"]) && !isset($_POST["cont_user"])) {
        $cont['error'] = 'Uno de los campos requeridos esta incompleto o vacio';
    } else {
        // print_r( $cont . "Realziando seguimiento a los campos");
        include_once("../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto -> conexionBD();

        // Informacion de tabla usuario empresa
        $id_user =                  $_POST["id_user"];
        $cont_user =                $_POST["cont_user"];
        $rad_us_nat =               $_POST["rad_us_nat"];
        $rad_us_emp =               $_POST["rad_us_emp"];
        $inp_rec_cred =             $_POST["inp_rec_cred"];

        if ($rad_us_nat == "true") {
            $tabla = "usuario_natural";
            $usuario = "numero_doc";
        } else {
            $tabla = "usuario_empresa";
            $usuario = "id_empresa";
        }

        try {
            
            $query = "SELECT * FROM $tabla WHERE $usuario = '$id_user' AND contrasena = '$cont_user'";
            $insert = $conexion->prepare($query);
            $insert->execute();
            $inf_query = $insert->fetch(PDO::FETCH_ASSOC);
            if ($insert->rowCount() == 1 ) {
                session_start();
                if ($rad_us_nat == "true") {
                    // Variables de sesion usuario natural
                    $url = "../pages/natural/inicio.php";
                    $_SESSION['tipo']           = 'n';
                    $_SESSION["num_doc"]        = $inf_query ["numero_doc"];
                    $_SESSION["pri_nom"]        = $inf_query ["primer_nombre"];
                    $_SESSION["seg_nom"]        = $inf_query ["segundo_nombre"];
                    $_SESSION["pri_ape"]        = $inf_query ["primer_apellido"];
                    $_SESSION["seg_ape"]        = $inf_query ["segundo_apellido"];
                    $_SESSION['nom_com']        = $inf_query ["primer_nombre"]  . ' ' .  $inf_query ["segundo_nombre"] . ' <br> ' .  $inf_query ["primer_apellido"] . ' ' . $inf_query ["segundo_apellido"]; 
                    $_SESSION["tip_doc"]        = $inf_query ["tipo_doc"];
                    $_SESSION["fec_nac"]        = $inf_query ["fecha_nacimiento"];
                    $_SESSION["sexo"]           = $inf_query ["sexo"];
                    $_SESSION["ednia"]          = $inf_query ["ednia"];
                    $_SESSION["con_nat"]        = $inf_query ["contrasena"];
                    $_SESSION["libreta"]        = $inf_query ["libreta"];
                    $_SESSION["num_libreta"]    = $inf_query ["num_libreta"];
                    $_SESSION["des_nat"]        = $inf_query ["descripcion"];
                    $_SESSION["fot_nat"]        = $inf_query ["foto"];
					$_SESSION["estado"]         = $inf_query ["estado"];
                    $_SESSION['time']           = time();
                    $_SESSION['minutos']        = 1800;
                    
                    if ($inp_rec_cred == "true") {
                        $_SESSION["rec_cred"]        = true;
                    } else {
                        $_SESSION["rec_cred"]        = false;
                    }

                    $query = "SELECT * FROM cont_usuario WHERE $usuario = '$id_user'";
                    $insert = $conexion->prepare($query);
                    $insert->execute();
                    $inf_query = $insert->fetch(PDO::FETCH_ASSOC);

                    if ($insert->rowCount() == 1 ) {
                        $_SESSION["correo"]         = $inf_query ["correo"];
                        $_SESSION["tel_nat"]        = $inf_query ["telefono"];
                        $_SESSION["dir_nat"]        = $inf_query ["direccion"];
                        $_SESSION["departamento"]   = $inf_query ["departamento"];
                        $_SESSION["municipio"]      = $inf_query ["municipio"];
                    }

                } else {
                    // Variables de sesion usuario empresa
                    $url = "../pages/empresa/inicio.php";
                    $_SESSION['tipo']           = 'e';
                    $_SESSION["id_empr"]        = $inf_query ["id_empresa"];
                    $_SESSION["razon_s"]        = $inf_query ["razon_social"];
                    $_SESSION["des_emp"]        = $inf_query ["descripcion"];
                    $_SESSION["fot_emp"]        = $inf_query ["foto"];
                    $_SESSION["mision"]         = $inf_query ["mision"];
                    $_SESSION["vision"]         = $inf_query ["vision"];
                    $_SESSION["log_emp"]        = $inf_query ["logo_empresa"];
                    $_SESSION["con_emp"]        = $inf_query ["contrasena"];
                    $_SESSION['time']           = time();
                    $_SESSION['minutos']        = 1800;
                    
                    $query = "SELECT * FROM cont_empresa WHERE $usuario = '$id_user'";
                    $insert = $conexion->prepare($query);
                    $insert->execute();
                    $inf_query = $insert->fetch(PDO::FETCH_ASSOC);

                    if ($inp_rec_cred == "true") {
                        $_SESSION["rec_cred"]        = true;
                    } else {
                        $_SESSION["rec_cred"]        = false;
                    }
                    
                    if ($insert->rowCount() == 1 ) {
                        $_SESSION["correo"]         = $inf_query ["correo"];
                        $_SESSION["tel_nat"]        = $inf_query ["telefono"];
                        $_SESSION["dir_emp"]        = $inf_query ["direccion"];
                        $_SESSION["departa"]        = $inf_query ["departamento"];
                        $_SESSION["ciudad"]         = $inf_query ["municipio"];
                    }
                }
                // Validacion de de ingreso correcto en base de datos
                if ($insert->rowCount() == 1) {
                    $cont['okay'] = "V";
                    if ($_SESSION['tipo'] == 'n') {
                        $cont['okay_nat'] = $_SESSION['tipo'];
                        $cont['url'] = $url;
                    } else {
                        $cont['okay_emp'] = $_SESSION['tipo'];
                        $cont['url'] = $url;
                    }
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