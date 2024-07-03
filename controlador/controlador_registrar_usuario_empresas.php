<?php

    if (isset($_POST["nom_reclu"]) && isset($_POST["ape_reclu"]) && isset($_POST["Razon_social"]) && isset($_POST["NIT"]) && isset($_POST["contacto_area"]) && isset($_POST["mision_emp"]) && isset($_POST["vision_emp"]) && isset($_POST["celular_emp"]) && isset($_POST["correo_emp"]) && isset($_POST["contrasena_emp"]) && isset($_POST["direccion_emp"])) {
        echo 'Uno de los campos requeridos esta incompleto o vacio';
    } else {
        $cont = [];
        include_once("../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto -> conexionBD();

        // Informacion de tabla usuario empresa
        // $archivo_foto_emp =          $_POST["archivo_foto_emp"];
        $razon_social =              $_POST["razon_social"];
        $nit =                       $_POST["nit"];
        $contacto_area_emp =         $_POST["contacto_area_emp"];
        $mision_emp =                $_POST["mision_emp"];
        $vision_emp =                $_POST["vision_emp"];
        $contrasena_emp =            $_POST["contrasena_emp"];

        // Infromacionde tabla de contacto
        // FK id empresa
        $celular_emp =               $_POST["celular_emp"];
        $correo_emp =                $_POST["correo_emp"];
        $direccion_emp =             $_POST["direccion_emp"];
        $departamento_emp =          $_POST["departamento_emp"];
		$municipios_emp =            $_POST["municipios_emp"];


        if(isset($_FILES["archivo"]["name"])){$archivo= $_FILES["archivo"]["name"];}else{ $archivo='';}
        
        // Subida y almacenamiento de imagen
        if (isset($_FILES['archivo_foto_emp']['name']) || isset($_FILES['archivo_logo']['name'])) {
            
            $targetDir = "../img/rgs_user_emp/$nit/";

            if (!file_exists($targetDir)){
                mkdir($targetDir,0755,true); 
            }

            if(isset($_FILES['archivo_foto_emp']["name"])){
                $file_name = $_FILES['archivo_foto_emp']["name"];
                
                $extension = pathinfo($_FILES['archivo_foto_emp']["name"],PATHINFO_EXTENSION);
                
                $file_name = $nit.'-'.'foto_emp'.'.'.$extension;
                $add = $targetDir . $file_name;
                
                $rutafoto1 = "../img/rgs_user_emp/$nit/$file_name";
                
                if(move_uploaded_file($_FILES['archivo_foto_emp']["tmp_name"],$add)){}
            
            }

            if(isset($_FILES['archivo_logo']["name"])){
                $file_name = $_FILES['archivo_logo']["name"];
                
                $extension = pathinfo($_FILES['archivo_logo']["name"],PATHINFO_EXTENSION);
                
                $file_name = $nit.'-'.'logo emp'.'.'.$extension;
                $add = $targetDir . $file_name;
                
                $rutafoto2 = "../img/rgs_user_emp/$nit/$file_name";
                
                if(move_uploaded_file($_FILES['archivo_logo']["tmp_name"],$add)){}
            
            }            
        }

        try {
            // Query SQL para ingreso de formulario
            $query =("INSERT INTO usuario_empresa (id_empresa,razon_social,descripcion,foto,mision,vision,logo_empresa,contrasena)
            VALUES (:nit,:raz_soc,:descr,:foto,:mis,:vis,:logo_emp,:cont)");
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':nit',$nit,PDO::PARAM_STR);
            $insert -> bindParam(':raz_soc',$razon_social,PDO::PARAM_STR);
            $insert -> bindParam(':descr',$contacto_area_emp,PDO::PARAM_STR);
            $insert -> bindParam(':foto',$rutafoto1,PDO::PARAM_STR);
            $insert -> bindParam(':mis',$mision_emp,PDO::PARAM_STR);
            $insert -> bindParam(':vis',$vision_emp,PDO::PARAM_STR);
            $insert -> bindParam(':logo_emp',$rutafoto2,PDO::PARAM_STR);
            $insert -> bindParam(':cont',$contrasena_emp,PDO::PARAM_STR);
            $insert->execute();

            $query_emp =("INSERT INTO cont_empresa (id_empresa,telefono,correo,direccion,departamento,municipio)
                    VALUES (:nit,:cel_emp,:corr_emp,:dir_emp,:depar,:munic)");
            $insert_emp = $conexion->prepare("$query_emp");
            $insert_emp -> bindParam(':nit',$nit,PDO::PARAM_STR);
            $insert_emp -> bindParam(':cel_emp',$celular_emp,PDO::PARAM_STR);
            $insert_emp -> bindParam(':corr_emp',$correo_emp,PDO::PARAM_STR);
            $insert_emp -> bindParam(':dir_emp',$direccion_emp,PDO::PARAM_STR);
            $insert_emp -> bindParam(':depar',$departamento_emp,PDO::PARAM_STR);
            $insert_emp -> bindParam(':munic',$municipios_emp,PDO::PARAM_STR);
            $insert_emp->execute();
            $cont['mensaje'] = "Inserción exitosa";
            $cont['url'] = "../pages/login.php";
        } catch (PDOException $e) {
            $cont['error'] = 'Error de usuario '. $nit .' ya existe' ;
        }
        echo json_encode($cont);
    }
?>