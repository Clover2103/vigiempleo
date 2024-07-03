<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["primer_nombre"]) && isset($_POST["primer_apellido"]) && isset($_POST["tipo_de_documento"]) && isset($_POST["cedula_de_ciudadania"]) && isset($_POST["Sexo"]) && isset($_POST["descripcion"]) && isset($_POST["archivo"])) {
        echo 'Uno de los campos requeridos esta incompleto o vacio segundo';
    } else {
        $cont = [];
        include_once("../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto -> conexionBD();
        session_start();
        $usuario = $_SESSION["num_doc"];

        // Informacion de tabla usuario natural
        $cedula_de_ciudadania       = $_POST["cedula_de_ciudadania"];
        $primer_nombre              = $_POST["primer_nombre"];
        $segundo_nombre             = $_POST["segundo_nombre"];
        $primer_apellido            = $_POST["primer_apellido"];
        $segundo_apellido           = $_POST["segundo_apellido"];
        $tipo_de_documento          = $_POST["tipo_de_documento"];
        $contacto_area              = $_POST["contacto_area"];

        // Informacion de tabla contacto
        // FK cedula de ciudadania
        $correo                     = $_POST["correo"];
        $celular_cont               = $_POST["celular_cont"];
        $direccion                  = $_POST["direccion"];

        // Insertar tabla referencia laboral primero
        // FK cedula de 
        $nombre_empresa             = $_POST["nombre_empresa"];
        $cargo                      = $_POST["cargo"];
        $tiempo_ingreso_exp         = $_POST["tiempo_ingreso_exp"];
        $tiempo_salida_1            = $_POST["tiempo_salida_1"];
        $jefe_inmediato             = $_POST["jefe_inmediato"];
        $celular_exp                = $_POST["celular_exp"];
        $val_exp_lab_1              = $_POST["val_exp_lab_1"];

        $nombre_empresa_2           = $_POST["nombre_empresa_2"];
        $cargo_2                    = $_POST["cargo_2"];
        $tiempo_ingreso_exp_2       = $_POST["tiempo_ingreso_exp_2"];
        $tiempo_salida_2            = $_POST["tiempo_salida_2"];
        $jefe_inmediato_2           = $_POST["jefe_inmediato_2"];
        $celular_exp_2              = $_POST["celular_exp_2"];
        $val_exp_lab_2              = $_POST["val_exp_lab_2"];

        // Insertar tabla formacion academica uno
        // FK cedula de ciudadania
        $nombre_instituto           = $_POST["nombre_instituto"];
        $nivel_academico            = $_POST["nivel_academico"];
        $titulo_op                  = $_POST["titulo_op"];
        $tiempo_fin_1               = $_POST["tiempo_fin_1"];
        $val_1                      = $_POST["val_1"];

        $nombre_instituto_2         = $_POST["nombre_instituto_2"];
        $nivel_academico_2          = $_POST["nivel_academico_2"];
        $titulo_op_2                = $_POST["titulo_op_2"];
        $tiempo_fin_2               = $_POST["tiempo_fin_2"];
        $val_2                      = $_POST["val_2"];

        // Insertar tabla cualificaciones
        // FK cedula de ciudadania
        $lug_cuali                  = $_POST["lug_cuali"];
        $lug_cualifica              = $_POST["lug_cualifica"];
        $fech_cualifi               = $_POST["fech_cualifi"];
        $doc_cualifi                = $_POST["doc_cualifi"];
        $val_cua_1                  = $_POST["val_cua_1"];

        $lug_cuali_2                = $_POST["lug_cuali_2"];
        $lug_cualifica_2            = $_POST["lug_cualifica_2"];
        $fech_cualifi_2             = $_POST["fech_cualifi_2"];
        $doc_cualifi_2              = $_POST["doc_cualifi_2"];
        $val_cua_2                  = $_POST["val_cua_2"];

        // Insertar tabla referencia personal
        // FK cedula de ciudadania
        $nomb_ref                   = $_POST["nomb_ref"];
        $ape_ref                    = $_POST["ape_ref"];
        $car_ref                    = $_POST["car_ref"];
        $cel_ref                    = $_POST["cel_ref"];
        $val_ref_per_1              = $_POST["val_ref_per_1"];

        $nomb_ref_2                 = $_POST["nomb_ref_2"];
        $ape_ref_2                  = $_POST["ape_ref_2"];
        $car_ref_2                  = $_POST["car_ref_2"];
        $cel_ref_2                  = $_POST["cel_ref_2"];
        $val_ref_per_2              = $_POST["val_ref_per_2"];

        if(isset($_FILES["archivo"]["name"])){$archivo= $_FILES["archivo"]["name"];}else{ $archivo='';}
        print_r($_FILES["archivo"]["name"]);
        // Subida y almacenamiento de imagen
        if (isset($_FILES['archivo']['name']) ) {
            
            $targetDir = "../img/rgs_user_nat/$cedula_de_ciudadania/";

            if (!file_exists($targetDir)){
                mkdir($targetDir,0755,true); 
                echo("Entre aqui pues papa");
            }

            if(isset($_FILES['archivo']["name"])){
                $file_name = $_FILES['archivo']["name"];
                
                $extension = pathinfo($_FILES['archivo']["name"],PATHINFO_EXTENSION);
                
                $file_name = $cedula_de_ciudadania.'-'.'foto'.'.'.$extension;
                $add = $targetDir . $file_name;
                
                $rutafoto1 = "../img/rgs_user_nat/$cedula_de_ciudadania/$file_name";
                
                if(move_uploaded_file($_FILES['archivo']["tmp_name"],$add)){}
            
            }

            // Query SQL para ingreso de formulario
            $query =("UPDATE 
                        usuario_natural
                    SET primer_nombre = :pri_nom,
                        segundo_nombre = :seg_nom,
                        primer_apellido = :pri_ape,
                        segundo_apellido = :seg_ape,
                        tipo_doc = :tip_doc,
                        numero_doc = :num_doc,
                        descripcion = :descri,
                        foto = :foto)
                    WHERE numero_doc = '$usuario'");

            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':pri_nom',$primer_nombre,PDO::PARAM_STR);
            $insert -> bindParam(':seg_nom',$segundo_nombre,PDO::PARAM_STR);
            $insert -> bindParam(':pri_ape',$primer_apellido,PDO::PARAM_STR);
            $insert -> bindParam(':seg_ape',$segundo_apellido,PDO::PARAM_STR);
            $insert -> bindParam(':tip_doc',$tipo_de_documento,PDO::PARAM_STR);
            $insert -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
            $insert -> bindParam(':descri',$contacto_area,PDO::PARAM_STR);
            $insert -> bindParam(':foto',$rutafoto1,PDO::PARAM_STR);
            $insert->execute();
            
            $query_cont =("UPDATE
                            cont_usuario
                        SET
                            numero_doc = :num_doc,
                            correo = :corr,
                            telefono = :tel,
                            direccion = :dir
                        WHERE 
                            numero_doc = '$usuario'");
                        
            $insert_cont = $conexion->prepare("$query_cont");
            $insert_cont -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
            $insert_cont -> bindParam(':corr',$correo,PDO::PARAM_STR);
            $insert_cont -> bindParam(':tel',$celular_cont,PDO::PARAM_STR);
            $insert_cont -> bindParam(':dir',$direccion,PDO::PARAM_STR);
            $insert_cont->execute();

            if (($nombre_empresa !== "") && ($cargo !== "") && ($tiempo_ingreso_exp !== "") && ($tiempo_salida_1 !== "") && ($jefe_inmediato !== "")) {
                $query_rl = ("SELECT
                                id_ref_lab 
                            FROM 
                                ref_laboral 
                            WHERE 
                                numero_doc = '142536' 
                            LIMIT 1");
                $insert_rl = $conexion->prepare("$query_rl");

                $query_ref_lab_uno =("UPDATE
                                        ref_laboral
                                    SET
                                        numero_doc = :num_doc,
                                        nom_empresa = :nom_emp,
                                        cargo = :cargo,
                                        tie_ingreso = :tie_ing_exp,
                                        tie_salida = :tie_sali_exp,
                                        jefe_inmediato = :jefe,
                                        tele_jefe = :tel_jefe
                                    WHERE 
                                        numero_doc = '$usuario'");
                $insert_ref_lab_uno = $conexion->prepare("$query_ref_lab_uno");
                $insert_ref_lab_uno -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_ref_lab_uno -> bindParam(':nom_emp',$nombre_empresa,PDO::PARAM_STR);
                $insert_ref_lab_uno -> bindParam(':cargo',$cargo,PDO::PARAM_STR);
                $insert_ref_lab_uno -> bindParam(':tie_ing_exp',$tiempo_ingreso_exp,PDO::PARAM_STR);
                $insert_ref_lab_uno -> bindParam(':tie_sali_exp',$tiempo_salida_1,PDO::PARAM_STR);
                $insert_ref_lab_uno -> bindParam(':jefe',$jefe_inmediato,PDO::PARAM_STR);
                $insert_ref_lab_uno -> bindParam(':tel_jefe',$celular_exp,PDO::PARAM_STR);
                $insert_ref_lab_uno->execute();
            }

            if (($nombre_empresa_2 !== "") && ($cargo_2 !== "") && ($tiempo_ingreso_exp_2 !== "") && ($tiempo_salida_2 !== "") && ($jefe_inmediato_2 !== "")) {
                $query_ref_lab_dos =("UPDATE
                                        ref_laboral
                                    SET
                                        numero_doc = :num_doc,
                                        nom_empresa = :nom_emp_2,
                                        cargo = :cargo_2,
                                        tie_ingreso = :tie_sali_exp_2,
                                        tie_salida = :tie_sali_exp_2,
                                        jefe_inmediato = :jefe_2,
                                        tele_jefe = :tel_jefe_2
                                    WHERE 
                                        numero_doc = '$usuario'");
                $insert_ref_lab_dos = $conexion->prepare("$query_ref_lab_dos");
                $insert_ref_lab_dos -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_ref_lab_dos -> bindParam(':nom_emp_2',$nombre_empresa_2,PDO::PARAM_STR);
                $insert_ref_lab_dos -> bindParam(':cargo_2',$cargo_2,PDO::PARAM_STR);
                $insert_ref_lab_dos -> bindParam(':tie_ing_exp_2',$tiempo_ingreso_exp_2,PDO::PARAM_STR);
                $insert_ref_lab_dos -> bindParam(':tie_sali_exp_2',$tiempo_salida_2,PDO::PARAM_STR);
                $insert_ref_lab_dos -> bindParam(':jefe_2',$jefe_inmediato_2,PDO::PARAM_STR);
                $insert_ref_lab_dos -> bindParam(':tel_jefe_2',$celular_exp_2,PDO::PARAM_STR);
                $insert_ref_lab_dos->execute();
            }

            if (($nombre_instituto !== "") && ($nivel_academico !== "") && ($titulo_op !== "") && ($tiempo_fin_1 !== "")) {
                $query_for_aca_uno =("UPDATE 
                                        estudios
                                    SET
                                        numero_doc = :num_doc,
                                        nom_insti = :nom_ins,
                                        nivel_aca = :niv_aca,
                                        titulo = :titulo,
                                        fec_fin = :fec_fin
                                    WHERE 
                                        numero_doc = '$usuario'");
                $insert_for_aca_uno = $conexion->prepare("$query_for_aca_uno");
                $insert_for_aca_uno -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_for_aca_uno -> bindParam(':nom_ins',$nombre_instituto,PDO::PARAM_STR);
                $insert_for_aca_uno -> bindParam(':niv_aca',$nivel_academico,PDO::PARAM_STR);
                $insert_for_aca_uno -> bindParam(':titulo',$titulo_op,PDO::PARAM_STR);
                $insert_for_aca_uno -> bindParam(':fec_fin',$tiempo_fin_1,PDO::PARAM_STR);
                $insert_for_aca_uno->execute();
            }

            if (($nombre_instituto_2 !== "") && ($nivel_academico_2 !== "") && ($titulo_op_2 !== "") && ($tiempo_fin_2 !== "")) {
                $query_for_aca_dos =("UPDATE
                                        estudios
                                    SET
                                        numero_doc = :num_doc,
                                        nom_insti = :nom_ins_2,
                                        nivel_aca = :niv_aca_2,
                                        titulo = :titulo_2,
                                        fec_fin = :fec_fin_2
                                    WHERE 
                                        numero_doc = '$usuario'");
                $insert_for_aca_dos = $conexion->prepare("$query_for_aca_dos");
                $insert_for_aca_dos -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_for_aca_dos -> bindParam(':nom_ins_2',$nombre_instituto_2,PDO::PARAM_STR);
                $insert_for_aca_dos -> bindParam(':niv_aca_2',$nivel_academico_2,PDO::PARAM_STR);
                $insert_for_aca_dos -> bindParam(':titulo_2',$titulo_op_2,PDO::PARAM_STR);
                $insert_for_aca_dos -> bindParam(':fec_fin_2',$tiempo_fin_2,PDO::PARAM_STR);
                $insert_for_aca_dos->execute();
            }

            if (($lug_cuali !== "") && ($lug_cualifica !== "") && ($fech_cualifi !== "") && ($doc_cualifi !== "")) {
                $query_cualifi_uno =("UPDATE
                                        cualificaciones
                                    SET
                                        numero_doc = :num_doc,
                                        lugar = :lug_cuali,
                                        nom_cualifi = :lug_cualifica,
                                        fec_cualifi = :fec_cuali,
                                        doc_cualifi = :doc_culi
                                    WHERE
                                        numero_doc = '$usuario'");
                $insert_cualifi_uno = $conexion->prepare("$query_cualifi_uno");
                $insert_cualifi_uno -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_cualifi_uno -> bindParam(':lug_cuali',$lug_cuali,PDO::PARAM_STR);
                $insert_cualifi_uno -> bindParam(':lug_cualifica',$lug_cualifica,PDO::PARAM_STR);
                $insert_cualifi_uno -> bindParam(':fec_cuali',$fech_cualifi,PDO::PARAM_STR);
                $insert_cualifi_uno -> bindParam(':doc_culi',$doc_cualifi,PDO::PARAM_STR);
                $insert_cualifi_uno->execute();
            }

            if (($lug_cuali_2 !== "") && ($lug_cualifica_2 !== "") && ($fech_cualifi_2 !== "") && ($doc_cualifi_2 !== "")) {
                $query_cualifi_dos =("UPDATE
                                        cualificaciones
                                    SET
                                        numero_doc = :num_doc,
                                        lugar = :lug_cuali_2,
                                        nom_cualifi = :lug_cualifica_2,
                                        fec_cualifi = :fec_cuali_2,
                                        doc_cualifi = :doc_culi_2
                                    WHERE
                                        numero_doc = '$usuario'");
                $insert_cualifi_dos = $conexion->prepare("$query_cualifi_dos");
                $insert_cualifi_dos -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_cualifi_dos -> bindParam(':lug_cuali_2',$lug_cuali_2,PDO::PARAM_STR);
                $insert_cualifi_dos -> bindParam(':lug_cualifica_2',$lug_cualifica_2,PDO::PARAM_STR);
                $insert_cualifi_dos -> bindParam(':fec_cuali_2',$fech_cualifi_2,PDO::PARAM_STR);
                $insert_cualifi_dos -> bindParam(':doc_culi_2',$doc_cualifi_2,PDO::PARAM_STR);
                $insert_cualifi_dos->execute();
            }

            if (($nomb_ref !== "") && ($ape_ref !== "") && ($cel_ref !== "") && ($car_ref !== "")) {
                $query_ref_per_uno =("UPDATE
                                        ref_personal
                                    SET
                                        numero_doc = :num_doc,
                                        nom_ref_per = :nom_ref,
                                        ape_ref_per = :ape_ref,
                                        telefono_ref = :cel_ref,
                                        cargo = :car_ref
                                    WHERE
                                        numero_doc = '$usuario'");
                $insert_ref_per_uno = $conexion->prepare("$query_ref_per_uno");
                $insert_ref_per_uno -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_ref_per_uno -> bindParam(':nom_ref',$nomb_ref,PDO::PARAM_STR);
                $insert_ref_per_uno -> bindParam(':ape_ref',$ape_ref,PDO::PARAM_STR);
                $insert_ref_per_uno -> bindParam(':cel_ref',$cel_ref,PDO::PARAM_STR);
                $insert_ref_per_uno -> bindParam(':car_ref',$car_ref,PDO::PARAM_STR);
                $insert_ref_per_uno->execute();
            }

            if (($nomb_ref_2 !== "") && ($ape_ref_2 !== "") && ($cel_ref_2 !== "") && ($car_ref_2 !== "")) {
                $query_ref_per_dos =("UPDATE
                                        ref_personal
                                    SET
                                        numero_doc = :num_doc,
                                        nom_ref_per = :nom_ref_2,
                                        ape_ref_per = :ape_ref_2,
                                        telefono_ref = :cel_ref_2,
                                        cargo = :car_ref_2
                                    WHERE
                                        numero_doc = '$usuario'");
                $insert_ref_per_dos = $conexion->prepare("$query_ref_per_dos");
                $insert_ref_per_dos -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_ref_per_dos -> bindParam(':nom_ref_2',$nomb_ref_2,PDO::PARAM_STR);
                $insert_ref_per_dos -> bindParam(':ape_ref_2',$ape_ref_2,PDO::PARAM_STR);
                $insert_ref_per_dos -> bindParam(':cel_ref_2',$cel_ref_2,PDO::PARAM_STR);
                $insert_ref_per_dos -> bindParam(':car_ref_2',$car_ref_2,PDO::PARAM_STR);
                $insert_ref_per_dos->execute();
            }
        }
        // Validacion de de ingreso correcto en base de datos
        if ($insert==1) {
            echo '<div class="success"> Usuario registrado correctamente </div>';
            $cont['okay'] = "V";
        } else {
            echo '<div class="alerta"> Error al registrar </div>';
            $cont['error'] = "F";
        }
        return json_encode($cont);
    }
}
    
?>