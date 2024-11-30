<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["primer_nombre"]) && isset($_POST["primer_apellido"]) && isset($_POST["tipo_de_documento"]) && isset($_POST["cedula_de_ciudadania"]) && isset($_POST["fecha_nacimiento"]) && isset($_POST["Sexo"]) && isset($_POST["edad"]) && isset($_POST["contrasena"]) && isset($_POST["posee_lib"]) && isset($_POST["numero_lib"]) && isset($_POST["descripcion"]) && isset($_POST["archivo"])) {
        echo 'Uno de los campos requeridos esta incompleto o vacio segundo';
    } else {
        $cont = [];
        include_once("../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto -> conexionBD();

        // Array de cargos de la base de datos
        $query = "SELECT * FROM cargos";
        $smtm = $conexion->prepare($query);
        $smtm->execute();
        $inf_car = $smtm->fetchAll(PDO::FETCH_OBJ);

        // Array de nivel academico
        $query = "SELECT * FROM nivel_academico";
        $smtm = $conexion->prepare($query);
        $smtm->execute();
        $inf_na = $smtm->fetchAll(PDO::FETCH_OBJ);

        // Array de ciclos de capacitaciones
        $query = "SELECT * FROM ciclo_capacitacion";
        $smtm = $conexion->prepare($query);
        $smtm->execute();
        $inf_cc = $smtm->fetchAll(PDO::FETCH_OBJ);

        // Array de ciclo de cualificaciones
        $query = "SELECT * FROM ciclo_cualificacion";
        $smtm = $conexion->prepare($query);
        $smtm->execute();
        $inf_cu = $smtm->fetchAll(PDO::FETCH_OBJ);

        // Informacion de tabla usuario natural
        $cedula_de_ciudadania       = $_POST["cedula_de_ciudadania"];
        $primer_nombre              = $_POST["primer_nombre"];
        $segundo_nombre             = $_POST["segundo_nombre"];
        $primer_apellido            = $_POST["primer_apellido"];
        $segundo_apellido           = $_POST["segundo_apellido"];
        $tipo_de_documento          = $_POST["tipo_de_documento"];
        $fecha_nacimiento           = $_POST["fecha_nacimiento"];
        $sexo                       = $_POST["sexo"];
        $ednia                      = $_POST["ednia"];
        $edad                       = $_POST["edad"];
        $contrasena                 = $_POST["contrasena"];
        $posee_lib                  = $_POST["posee_lib"];
        $numero_lib                 = $_POST["numero_lib"];
        $posee_lic                  = $_POST["posee_lic"];
        $numero_lic                 = $_POST["numero_lic"];
        $cate_lic                   = $_POST["cate_lic"];
        $contacto_area              = $_POST["contacto_area"];

        // Informacion de tabla contacto
        // FK cedula de ciudadania
        $correo                     = $_POST["correo"];
        $celular_cont               = $_POST["celular_cont"];
        $direccion                  = $_POST["direccion"];
		$departamento               = $_POST["departamento"];
        $municipios                 = $_POST["municipios"];

        // Insertar tabla referencia laboral primero
        // FK cedula de ciudadania
        $nombre_empresa             = $_POST["nombre_empresa"];
        $cargo                      = $_POST["cargo"];
        $cargo_dese                 = $_POST["cargo_dese"];
        $tiempo_ingreso_exp         = $_POST["tiempo_ingreso_exp"];
        $tiempo_salida_1            = $_POST["tiempo_salida_1"];
        $sig_trab                   = $_POST["sig_trab"];
        $jefe_inmediato             = $_POST["jefe_inmediato"];
        $celular_exp                = $_POST["celular_exp"];

        $nombre_empresa_2           = $_POST["nombre_empresa_2"];
        $cargo_2                    = $_POST["cargo_2"];
        $cargo_dese_2               = $_POST["cargo_dese_2"];
        $tiempo_ingreso_exp_2       = $_POST["tiempo_ingreso_exp_2"];
        $tiempo_salida_2            = $_POST["tiempo_salida_2"];
        $sig_trab_2                 = $_POST["sig_trab_2"];
        $jefe_inmediato_2           = $_POST["jefe_inmediato_2"];
        $celular_exp_2              = $_POST["celular_exp_2"];

        // Insertar tabla formacion academica uno
        // FK cedula de ciudadania
        $nombre_instituto           = $_POST["nombre_instituto"];
        $nivel_academico            = $_POST["nivel_academico"];
        $titulo_op                  = $_POST["titulo_op"];
        $culm_aca                   = $_POST["culm_aca"];
        $tiempo_fin_1               = $_POST["tiempo_fin_1"];
        $sigo_estu                  = $_POST["sigo_estu"];

        $nombre_instituto_2         = $_POST["nombre_instituto_2"];
        $nivel_academico_2          = $_POST["nivel_academico_2"];
        $titulo_op_2                = $_POST["titulo_op_2"];
        $culm_aca_2                 = $_POST["culm_aca_2"];
        $tiempo_fin_2               = $_POST["tiempo_fin_2"];
        $sigo_estu_2                = $_POST["sigo_estu_2"];

        // Insertar tabla otros estudios
        // FK cedula de ciudadania
        $nombre_instituto_otro      = $_POST["nombre_instituto_otro"];
        $titulo_op_otro             = $_POST["titulo_op_otro"];
        $tiempo_fin_otro_1          = $_POST["tiempo_fin_otro_1"];

        $nombre_instituto_otro_2    = $_POST["nombre_instituto_otro_2"];
        $titulo_op_otro_2           = $_POST["titulo_op_otro_2"];
        $tiempo_fin_otro_2          = $_POST["tiempo_fin_otro_2"];

        // Insertar tabla capacitacion
        // FK cedula de ciudadania
        $lug_capaci                 = $_POST["lug_capaci"];
        $lug_capacita               = $_POST["lug_capacita"];
        $fech_capacita              = $_POST["fech_capacita"];

        $lug_capaci_2               = $_POST["lug_capaci_2"];
        $lug_capacita_2             = $_POST["lug_capacita_2"];
        $fech_capacita_2            = $_POST["fech_capacita_2"];

        $checkNo                    = $_POST["checkNo"];
        
        // Insertar tabla cualificaciones
        // FK cedula de ciudadania
        $lug_cuali                  = $_POST["lug_cuali"];
        $lug_cualifica              = $_POST["lug_cualifica"];
        $fech_cualifi               = $_POST["fech_cualifi"];

        $lug_cuali_2                = $_POST["lug_cuali_2"];
        $lug_cualifica_2            = $_POST["lug_cualifica_2"];
        $fech_cualifi_2             = $_POST["fech_cualifi_2"];

        // Insertar tabla referencia personal
        // FK cedula de ciudadania
        $nomb_ref                   = $_POST["nomb_ref"];
        $ape_ref                    = $_POST["ape_ref"];
        $cel_ref                    = $_POST["cel_ref"];
        $car_ref                    = $_POST["car_ref"];

        $nomb_ref_2                 = $_POST["nomb_ref_2"];
        $ape_ref_2                  = $_POST["ape_ref_2"];
        $cel_ref_2                  = $_POST["cel_ref_2"];
        $car_ref_2                  = $_POST["car_ref_2"];

        if(isset($_FILES["archivo"]["name"])){$archivo= $_FILES["archivo"]["name"];}else{ $archivo='';}

        // Subida y almacenamiento de imagen
        if (isset($_FILES['archivo']['name']) ) {

            // Creacion de directorio de ruta de imagen
            $targetDir = "../img/rgs_user_nat/$cedula_de_ciudadania/";

            if (!file_exists($targetDir)){
                mkdir($targetDir,0755,true);
            }

            // Archivo de foto
            if(isset($_FILES['archivo']["name"])){
                $file_name = $_FILES['archivo']["name"];
                
                $extension = pathinfo($_FILES['archivo']["name"],PATHINFO_EXTENSION);
                
                $file_name = $cedula_de_ciudadania.'-'.'foto'.'.'.$extension;
                $add = $targetDir . $file_name;
                
                $rutafoto1 = "../img/rgs_user_nat/$cedula_de_ciudadania/$file_name";
                
                if(move_uploaded_file($_FILES['archivo']["tmp_name"],$add)){}
            
            }

            // Inicialización de variables
            $rutaRefLab = "";
            $rutaRefLab2 = "";
            $rutaEstFor = "";
            $rutaEstFor2 = "";
            $rutaOtro = "";
            $rutaOtro2 = "";
            $rutaDocCua = "";
            $rutaDocCua2 = "";
            $rutaDocCap = "";
            $rutaDocCap2 = "";

            // Creacion de directorio de ruta de primer referencia laboral
            $targetLab = "../documents/ref_lab/$cedula_de_ciudadania/";

            if (!file_exists($targetLab)){
                mkdir($targetLab, 0755, true);
            }

            // Archivo de referencia laboral
            if(!empty($_FILES['compro_laboral']["name"])){
                $file_name = $_FILES['compro_laboral']["name"];
                $extension = pathinfo($_FILES['compro_laboral']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-ref_lab.' . $extension;
                $add = $targetLab . $file_name;
                $rutaRefLab = "../documents/ref_lab/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['compro_laboral']["tmp_name"], $add)){}
            }

            // Creacion de directorio de ruta de segunda referencia laboral
            $targetLab2 = "../documents/ref_lab/$cedula_de_ciudadania/";

            if (!file_exists($targetLab2)){
                mkdir($targetLab2, 0755, true);
            }

            // Archivo de la segunda referencia laboral
            if(!empty($_FILES['compro_laboral_2']["name"])){
                $file_name = $_FILES['compro_laboral_2']["name"];
                $extension = pathinfo($_FILES['compro_laboral_2']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-ref_lab2.' . $extension;
                $add = $targetLab2 . $file_name;
                $rutaRefLab2 = "../documents/ref_lab/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['compro_laboral_2']["tmp_name"], $add)){}
            }

            // Creacion de directorio de ruta de primer certificado de estudio
            $targetEst = "../documents/est_for/$cedula_de_ciudadania/";

            if (!file_exists($targetEst)){
                mkdir($targetEst, 0755, true);
            }

            // Archivo de la primera certificacion de estudio
            if(!empty($_FILES['comp_est_for']["name"])){
                $file_name = $_FILES['comp_est_for']["name"];
                $extension = pathinfo($_FILES['comp_est_for']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-est_for.' . $extension;
                $add = $targetEst . $file_name;
                $rutaEstFor = "../documents/est_for/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['comp_est_for']["tmp_name"], $add)){}
            }

            // Creacion de directorio de ruta de segunda certificado de estudio
            $targetEst2 = "../documents/est_for/$cedula_de_ciudadania/";

            if (!file_exists($targetEst2)){
                mkdir($targetEst2, 0755, true);
            }

            // Archivo de la segunda certificacion de estudio
            if(!empty($_FILES['comp_est_for_2']["name"])){
                $file_name = $_FILES['comp_est_for_2']["name"];
                $extension = pathinfo($_FILES['comp_est_for_2']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-est_for2.' . $extension;
                $add = $targetEst2 . $file_name;
                $rutaEstFor2 = "../documents/est_for/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['comp_est_for_2']["tmp_name"], $add)){}
            }

            // Creacion de directorio de la primera certificado de otros estudios
            $targetOtro = "../documents/otro/$cedula_de_ciudadania/";

            if (!file_exists($targetOtro)){
                mkdir($targetOtro, 0755, true);
            }

            // Archivo de la primera certificacion de otros estudios
            if(!empty($_FILES['comp_otro']["name"])){
                $file_name = $_FILES['comp_otro']["name"];
                $extension = pathinfo($_FILES['comp_otro']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-otro.' . $extension;
                $add = $targetOtro . $file_name;
                $rutaOtro = "../documents/otro/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['comp_otro']["tmp_name"], $add)){}
            }

            // Creacion de directorio de la primera certificado de otros estudios
            $targetOtro2 = "../documents/otro/$cedula_de_ciudadania/";

            if (!file_exists($targetOtro2)){
                mkdir($targetOtro2, 0755, true);
            }

            // Archivo de la primera certificacion de otros estudios
            if(!empty($_FILES['comp_otro_2']["name"])){
                $file_name = $_FILES['comp_otro_2']["name"];
                $extension = pathinfo($_FILES['comp_otro_2']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-otro2.' . $extension;
                $add = $targetOtro2 . $file_name;
                $rutaOtro2 = "../documents/otro/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['comp_otro_2']["tmp_name"], $add)){}
            }

            // Creacion de directorio de ruta de segunda cualificacion
            $targetCua = "../documents/cualificaciones/$cedula_de_ciudadania/";

            if (!file_exists($targetCua)){
                mkdir($targetCua, 0755, true);
            }

            // Archivo de la primera cualificacion
            if(!empty($_FILES['doc_cualifi']["name"])){
                $file_name = $_FILES['doc_cualifi']["name"];
                $extension = pathinfo($_FILES['doc_cualifi']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-doc.' . $extension;
                $add = $targetCua . $file_name;
                $rutaDocCua = "../documents/cualificaciones/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['doc_cualifi']["tmp_name"], $add)){}
            }
            
            // Creacion de directorio de segunda cualificacion
            $targetCua2 = "../documents/cualificaciones/$cedula_de_ciudadania/";

            if (!file_exists($targetCua2)){
                mkdir($targetCua2, 0755, true);
            }

            // Archivo de la segunda cualificacion
            if(!empty($_FILES['doc_cualifi_2']["name"])){
                $file_name = $_FILES['doc_cualifi_2']["name"];
                $extension = pathinfo($_FILES['doc_cualifi_2']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-doc2.' . $extension;
                $add = $targetCua2 . $file_name;
                $rutaDocCua2 = "../documents/cualificaciones/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['doc_cualifi_2']["tmp_name"], $add)){}
            }

            // Creacion de directorio de primera capacitacion
            $targetCap = "../documents/capacitaciones/$cedula_de_ciudadania/";

            if (!file_exists($targetCap)){
                mkdir($targetCap, 0755, true);
            }

            // Archivo de la primera capacitacion
            if(!empty($_FILES['doc_capacita']["name"])){
                $file_name = $_FILES['doc_capacita']["name"];
                $extension = pathinfo($_FILES['doc_capacita']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-doc.' . $extension;
                $add = $targetCap . $file_name;
                $rutaDocCap = "../documents/capacitaciones/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['doc_capacita']["tmp_name"], $add)){}
            }

            // Creacion de directorio de segunda capacitacion
            $targetCap2 = "../documents/capacitaciones/$cedula_de_ciudadania/";

            if (!file_exists($targetCap2)){
                mkdir($targetCap2, 0755, true);
            }

            // Archivo de la segunda capacitacion
            if(!empty($_FILES['doc_capacita_2']["name"])){
                $file_name = $_FILES['doc_capacita_2']["name"];
                $extension = pathinfo($_FILES['doc_capacita_2']["name"], PATHINFO_EXTENSION);
                $file_name = $cedula_de_ciudadania . '-doc2.' . $extension;
                $add = $targetCap2 . $file_name;
                $rutaDocCap2 = "../documents/capacitaciones/$cedula_de_ciudadania/$file_name";

                if(move_uploaded_file($_FILES['doc_capacita_2']["tmp_name"], $add)){}
            }

            // Inicio de estructura TRY // CATCH
            try {


                // Inserción de informacion general de usuario natural
                $query =("INSERT INTO usuario_natural (numero_doc,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,tipo_doc,
                fecha_nacimiento,sexo,ednia,edad,contrasena,libreta,num_libreta,descripcion,foto,licencia,num_licencia,cate_lic)
                VALUES (:num_doc,:pri_nom,:seg_nom,:pri_ape,:seg_ape,:tip_doc,:fec_nac,:sexo,:ednia,:edad,:contra,:lib,:num_lib,:descri,:foto,:lic,:num_lic,:cat_lic)");
                $insert = $conexion->prepare("$query");
                $insert -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert -> bindParam(':pri_nom',$primer_nombre,PDO::PARAM_STR);
                $insert -> bindParam(':seg_nom',$segundo_nombre,PDO::PARAM_STR);
                $insert -> bindParam(':pri_ape',$primer_apellido,PDO::PARAM_STR);
                $insert -> bindParam(':seg_ape',$segundo_apellido,PDO::PARAM_STR);
                $insert -> bindParam(':tip_doc',$tipo_de_documento,PDO::PARAM_STR);
                $insert -> bindParam(':fec_nac',$fecha_nacimiento,PDO::PARAM_STR);
                $insert -> bindParam(':sexo',$sexo,PDO::PARAM_STR);
                $insert -> bindParam(':ednia',$ednia,PDO::PARAM_STR);
                $insert -> bindParam(':edad',$edad,PDO::PARAM_STR);
                $insert -> bindParam(':contra',$contrasena,PDO::PARAM_STR);
                $insert -> bindParam(':lib',$posee_lib,PDO::PARAM_STR);
                $insert -> bindParam(':num_lib',$numero_lib,PDO::PARAM_STR);
                $insert -> bindParam(':descri',$contacto_area,PDO::PARAM_STR);
                $insert -> bindParam(':foto',$rutafoto1,PDO::PARAM_STR);
                $insert -> bindParam(':lic',$posee_lic,PDO::PARAM_STR);
                $insert -> bindParam(':num_lic',$numero_lic,PDO::PARAM_STR);
                $insert -> bindParam(':cat_lic',$cate_lic,PDO::PARAM_STR);
                $insert->execute();
                

                // Inserción de información general de usuario natural
                $query_cont =("INSERT INTO cont_usuario (numero_doc,correo,telefono,direccion,departamento,municipio)
                            VALUES (:num_doc,:corr,:tel,:dir,:dep,:mun)");
                $insert_cont = $conexion->prepare("$query_cont");
                $insert_cont -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                $insert_cont -> bindParam(':corr',$correo,PDO::PARAM_STR);
                $insert_cont -> bindParam(':tel',$celular_cont,PDO::PARAM_STR);
                $insert_cont -> bindParam(':dir',$direccion,PDO::PARAM_STR);
                $insert_cont -> bindParam(':dep',$departamento,PDO::PARAM_STR);
                $insert_cont -> bindParam(':mun',$municipios,PDO::PARAM_STR);
                $insert_cont->execute();


                // Validación de la primera referencia laboral si los campos estan completos
                if (($nombre_empresa !== "") && ($cargo !== "") && ($tiempo_ingreso_exp !== "") && ($jefe_inmediato !== "") && ($celular_exp !== "") && ($sig_trab !== "")) {
                    
                    // En caso de que siga trabajando en la primera referencia laboral
                    if ($sig_trab === "si") {

                        // Inserción de primera referencia laboral en caso de ser positivo
                        $query_rl_1 =("INSERT INTO ref_laboral (numero_doc,nom_empresa,cod_cargo,cargo,sig_trab,tie_ingreso,jefe_inmediato,tele_jefe,comp_lab)
                                    VALUES (:num_doc,:nom_emp,:cod_cargo,:cargo,:sig_trab,:tie_ing_exp,:jefe,:tel_jefe,:doc_comp)");
                        $smtm_rl_1 = $conexion->prepare("$query_rl_1");
                        $smtm_rl_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':nom_emp',$nombre_empresa,PDO::PARAM_STR);
                        if ($cargo == "06") {
                            $smtm_rl_1 -> bindParam(':cargo',$cargo_dese,PDO::PARAM_STR);
                        } else {
                            foreach ($inf_car as $c) {
                                if ($c -> cod_cargo == $cargo) {
                                    $car = $c -> cargo;
                                    $smtm_rl_1 -> bindParam(':cargo',$car,PDO::PARAM_STR);
                                }
                            }
                        }
                        $smtm_rl_1 -> bindParam(':cod_cargo',$cargo,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':sig_trab',$sig_trab,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':tie_ing_exp',$tiempo_ingreso_exp,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':jefe',$jefe_inmediato,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':tel_jefe',$celular_exp,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':doc_comp',$rutaRefLab,PDO::PARAM_STR);
                        $smtm_rl_1 -> execute();

                    // En caso de que no siga trabajando en la primera referencia laboral
                    } else {

                        // Inserción de segunda referencia laboral en caso de ser negativo
                        $query_rl_1 =("INSERT INTO ref_laboral (numero_doc,nom_empresa,cod_cargo,cargo,sig_trab,tie_ingreso,tie_salida,jefe_inmediato,tele_jefe,comp_lab)
                                    VALUES (:num_doc,:nom_emp,:cod_cargo,:cargo,:sig_trab,:tie_ing_exp,:tie_sali_exp,:jefe,:tel_jefe,:doc_comp)");
                        $smtm_rl_1 = $conexion->prepare("$query_rl_1");
                        $smtm_rl_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':nom_emp',$nombre_empresa,PDO::PARAM_STR);
                        if ($cargo == "06") {
                            $smtm_rl_1 -> bindParam(':cargo',$cargo_dese,PDO::PARAM_STR);
                        } else {
                            foreach ($inf_car as $c) {
                                if ($c -> cod_cargo == $cargo) {
                                    $car = $c -> cargo;
                                    $smtm_rl_1 -> bindParam(':cargo',$car,PDO::PARAM_STR);
                                }
                            }
                        }
                        $smtm_rl_1 -> bindParam(':cod_cargo',$cargo,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':sig_trab',$sig_trab,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':tie_ing_exp',$tiempo_ingreso_exp,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':tie_sali_exp',$tiempo_salida_1,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':jefe',$jefe_inmediato,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':tel_jefe',$celular_exp,PDO::PARAM_STR);
                        $smtm_rl_1 -> bindParam(':doc_comp',$rutaRefLab,PDO::PARAM_STR);
                        $smtm_rl_1 -> execute();

                    }
                    
                }


                // Validación de la segunda referencia laboral si los campos estan completos
                if (($nombre_empresa_2 !== "") && ($cargo_2 !== "") && ($tiempo_ingreso_exp_2 !== "") && ($jefe_inmediato_2 !== "") && ($celular_exp_2 !== "") && ($sig_trab_2 !== "")) {

                    // En caso de que siga trabajando en la primera referencia laboral
                    if ($sig_trab_2 === "si") {

                        // Inserción de primera referencia laboral en caso de ser positivo
                        $query_rl_2 =("INSERT INTO ref_laboral (numero_doc,nom_empresa,cod_cargo,cargo,sig_trab,tie_ingreso,jefe_inmediato,tele_jefe,comp_lab)
                                    VALUES (:num_doc,:nom_emp,:cod_cargo,:cargo,:sig_trab,:tie_ing_exp,:jefe,:tel_jefe,:doc_comp)");
                        $smtm_rl_2 = $conexion->prepare("$query_rl_2");
                        $smtm_rl_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':nom_emp',$nombre_empresa_2,PDO::PARAM_STR);
                        if ($cargo_2 == "06") {
                            $smtm_rl_2 -> bindParam(':cargo',$cargo_dese_2,PDO::PARAM_STR);
                        } else {
                            foreach ($inf_car as $c) {
                                if ($c -> cod_cargo == $cargo_2) {
                                    $car = $c -> cargo;
                                    $smtm_rl_2 -> bindParam(':cargo',$car,PDO::PARAM_STR);
                                }
                            }
                        }
                        $smtm_rl_2 -> bindParam(':cod_cargo',$cargo_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':sig_trab',$sig_trab_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':tie_ing_exp',$tiempo_ingreso_exp_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':jefe',$jefe_inmediato_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':tel_jefe',$celular_exp_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':doc_comp',$rutaRefLab2,PDO::PARAM_STR);
                        $smtm_rl_2 -> execute();

                    // En caso de que no siga trabajando en la primera referencia laboral
                    } else {

                        // Inserción de segunda referencia laboral en caso de ser negativo
                        $query_rl_2 =("INSERT INTO ref_laboral (numero_doc,nom_empresa,cod_cargo,cargo,sig_trab,tie_ingreso,tie_salida,jefe_inmediato,tele_jefe,comp_lab)
                                    VALUES (:num_doc,:nom_emp,:cod_cargo,:cargo,:sig_trab,:tie_ing_exp,:tie_sali_exp,:jefe,:tel_jefe,:doc_comp)");
                        $smtm_rl_2 = $conexion->prepare("$query_rl_2");
                        $smtm_rl_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':nom_emp',$nombre_empresa_2,PDO::PARAM_STR);
                        if ($cargo_2 == "06") {
                            $smtm_rl_2 -> bindParam(':cargo',$cargo_dese_2,PDO::PARAM_STR);
                        } else {
                            foreach ($inf_car as $c) {
                                if ($c -> cod_cargo == $cargo_2) {
                                    $car = $c -> cargo;
                                    $smtm_rl_2 -> bindParam(':cargo',$car,PDO::PARAM_STR);
                                }
                            }
                        }
                        $smtm_rl_2 -> bindParam(':cod_cargo',$cargo_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':sig_trab',$sig_trab_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':tie_ing_exp',$tiempo_ingreso_exp_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':tie_sali_exp',$tiempo_salida_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':jefe',$jefe_inmediato_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':tel_jefe',$celular_exp_2,PDO::PARAM_STR);
                        $smtm_rl_2 -> bindParam(':doc_comp',$rutaRefLab2,PDO::PARAM_STR);
                        $smtm_rl_2 -> execute();

                    }

                }


                // Validación de los primeros estudios formales si los campos estan completos
                if (($nombre_instituto !== "") && ($nivel_academico !== "") && ($titulo_op !== "")) {

                    // En caso de que si halla culminado en la primera certificacion academica
                    if ($culm_aca === "si") {

                        // En caso de que siga trabajando en la primera referencia laboral
                        $query_fa_1 =("INSERT INTO estudios (numero_doc,nom_insti,cod_na,nivel_aca,titulo,fec_fin,culmino,sig_estu,comp_est)
                        VALUES (:num_doc,:nom_ins,:cod_na,:niv_aca,:titulo,:fec_fin,:culmino,:sigo_estu,:doc_est)");
                        $smtm_fa_1 = $conexion->prepare("$query_fa_1");
                        $smtm_fa_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':nom_ins',$nombre_instituto,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':cod_na',$nivel_academico,PDO::PARAM_STR);
                        foreach ($inf_na as $f) {
                            if ($f -> cod_na == $nivel_academico) {
                                $for = $f -> nivel_academico;
                                $smtm_fa_1 -> bindParam(':niv_aca',$for,PDO::PARAM_STR);
                            }
                        }
                        $smtm_fa_1 -> bindParam(':titulo',$titulo_op,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':fec_fin',$tiempo_fin_1,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':culmino',$culm_aca,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':sigo_estu',$sigo_estu,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':doc_est',$rutaEstFor,PDO::PARAM_STR);
                        $smtm_fa_1->execute();

                    // En caso de que no halla culminado la primera formacion academica
                    } else {

                        // En caso de que siga trabajando en la primera referencia laboral
                        $query_fa_1 =("INSERT INTO estudios (numero_doc,nom_insti,cod_na,nivel_aca,titulo,culmino,sig_estu,comp_est)
                        VALUES (:num_doc,:nom_ins,:cod_na,:niv_aca,:titulo,:culmino,:sigo_estu,:doc_est)");
                        $smtm_fa_1 = $conexion->prepare("$query_fa_1");
                        $smtm_fa_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':nom_ins',$nombre_instituto,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':cod_na',$nivel_academico,PDO::PARAM_STR);
                        foreach ($inf_na as $f) {
                            if ($f -> cod_na == $nivel_academico) {
                                $for = $f -> nivel_academico;
                                $smtm_fa_1 -> bindParam(':niv_aca',$for,PDO::PARAM_STR);
                            }
                        }
                        $smtm_fa_1 -> bindParam(':titulo',$titulo_op,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':culmino',$culm_aca,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':sigo_estu',$sigo_estu,PDO::PARAM_STR);
                        $smtm_fa_1 -> bindParam(':doc_est',$rutaEstFor,PDO::PARAM_STR);
                        $smtm_fa_1->execute();
                    }
                   
                }


                // Validación de los segundos estudios formales si los campos estan completos
                if (($nombre_instituto_2 !== "") && ($nivel_academico_2 !== "") && ($titulo_op_2 !== "")) {

                    // En caso de que si halla culminado en la segunda certificacion academica
                    if ($culm_aca_2 === "si") {

                        // En caso de que siga trabajando en la segunda certificacion academica
                        $query_fa_2 =("INSERT INTO estudios (numero_doc,nom_insti,cod_na,nivel_aca,titulo,fec_fin,culmino,sig_estu,comp_est)
                        VALUES (:num_doc,:nom_ins,:cod_na,:niv_aca,:titulo,:fec_fin,:culmino,:sigo_estu,:doc_est)");
                        $smtm_fa_2 = $conexion->prepare("$query_fa_2");
                        $smtm_fa_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':nom_ins',$nombre_instituto_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':cod_na',$nivel_academico_2,PDO::PARAM_STR);
                        foreach ($inf_na as $f) {
                            if ($f -> cod_na == $nivel_academico_2) {
                                $for = $f -> nivel_academico;
                                $smtm_fa_2 -> bindParam(':niv_aca',$for,PDO::PARAM_STR);
                            }
                        }
                        $smtm_fa_2 -> bindParam(':titulo',$titulo_op_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':fec_fin',$tiempo_fin_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':culmino',$culm_aca_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':sigo_estu',$sigo_estu_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':doc_est',$rutaEstFor2,PDO::PARAM_STR);
                        $smtm_fa_2 ->execute();

                    // En caso de que no halla culminado la segunda certificacion academica
                    } else {

                        // En caso de que siga trabajando en la segunda certificacion academica
                        $query_fa_2 =("INSERT INTO estudios (numero_doc,nom_insti,cod_na,nivel_aca,titulo,culmino,sig_estu,comp_est)
                        VALUES (:num_doc,:nom_ins,:cod_na,:niv_aca,:titulo,:culmino,:sigo_estu,:doc_est)");
                        $smtm_fa_2 = $conexion->prepare("$query_fa_2");
                        $smtm_fa_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':nom_ins',$nombre_instituto_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':cod_na',$nivel_academico_2,PDO::PARAM_STR);
                        foreach ($inf_na as $f) {
                            if ($f -> cod_na == $nivel_academico_2) {
                                $for = $f -> nivel_academico;
                                $smtm_fa_2 -> bindParam(':niv_aca',$for,PDO::PARAM_STR);
                            }
                        }
                        $smtm_fa_2 -> bindParam(':titulo',$titulo_op_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':culmino',$culm_aca_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':sigo_estu',$sigo_estu_2,PDO::PARAM_STR);
                        $smtm_fa_2 -> bindParam(':doc_est',$rutaEstFor2,PDO::PARAM_STR);
                        $smtm_fa_2->execute();
                    }
                   
                }
                
                // Validación de la primera seccion donde los estudios adicionales esten complestos
                if (($nombre_instituto_otro !== "") && ($titulo_op_otro !== "") && ($tiempo_fin_otro_1 !== "")) {

                    // Insercion de los datos que vienen del front en la base de datos de la primera seccion de los estudios adicionales
                    $query_o_1 =("INSERT INTO otro_estudios (numero_doc,nivel_ins_otro,titulo_otro,fec_fin_otro,comp_otro)
                                    VALUES (:num_doc,:nom_int_ot,:titu_ot,:fec_ot,:doc_otro)");
                    $smtm_o_1 = $conexion->prepare("$query_o_1");
                    $smtm_o_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_o_1 -> bindParam(':nom_int_ot',$nombre_instituto_otro,PDO::PARAM_STR);
                    $smtm_o_1 -> bindParam(':titu_ot',$titulo_op_otro,PDO::PARAM_STR);
                    $smtm_o_1 -> bindParam(':fec_ot',$tiempo_fin_otro_1,PDO::PARAM_STR);
                    $smtm_o_1 -> bindParam(':doc_otro',$rutaOtro,PDO::PARAM_STR);
                    $smtm_o_1 -> execute();

                }
                
                // Validación de la segunda seccion donde los estudios adicionales esten complestos
                if (($nombre_instituto_otro_2 !== "") && ($titulo_op_otro_2 !== "") && ($tiempo_fin_otro_2 !== "")) {

                    // Insercion de los datos que vienen del front en la base de datos de la segunda seccion de los estudios adicionales
                    $query_o_2 =("INSERT INTO otro_estudios (numero_doc,nivel_ins_otro,titulo_otro,fec_fin_otro,comp_otro)
                                    VALUES (:num_doc,:nom_int_ot,:titu_ot,:fec_ot,:doc_otro)");
                    $smtm_o_2 = $conexion->prepare("$query_o_2");
                    $smtm_o_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_o_2 -> bindParam(':nom_int_ot',$nombre_instituto_otro_2,PDO::PARAM_STR);
                    $smtm_o_2 -> bindParam(':titu_ot',$titulo_op_otro_2,PDO::PARAM_STR);
                    $smtm_o_2 -> bindParam(':fec_ot',$tiempo_fin_otro_2,PDO::PARAM_STR);
                    $smtm_o_2 -> bindParam(':doc_otro',$rutaOtro2,PDO::PARAM_STR);
                    $smtm_o_2 ->execute();

                }
                
                // Validacion de la primera capacitacion donde los campos se encuentren completos
                if (($lug_capaci !== "") && ($lug_capacita !== "") && ($fech_capacita !== "") && ($rutaDocCap !== "")) {

                    // Insercion en la base de datos de los campos de datos que se encuentran en el front de la primera capacitacion
                    $query_cap_1 =("INSERT INTO capacitaciones (numero_doc,lugar,cod_cap,nom_cuapa,fec_cuapa,doc_cuapa)
                                    VALUES (:num_doc,:lug_capa,:cod_cap,:lug_capaci,:fec_capa,:doc_capa)");
                    $smtm_cap_1 = $conexion->prepare("$query_cap_1");
                    $smtm_cap_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_cap_1 -> bindParam(':lug_capa',$lug_capaci,PDO::PARAM_STR);
                    foreach ($inf_cc as $cc) {
                        if ($cc -> cod_cap == $lug_capacita) {
                            $cap = $cc -> capacitacion;
                            $smtm_cap_1 -> bindParam(':lug_capaci',$cap,PDO::PARAM_STR);
                        }
                    }
                    $smtm_cap_1 -> bindParam(':cod_cap',$lug_capacita,PDO::PARAM_STR);
                    $smtm_cap_1 -> bindParam(':fec_capa',$fech_capacita,PDO::PARAM_STR);
                    $smtm_cap_1 -> bindParam(':doc_capa',$rutaDocCap,PDO::PARAM_STR);
                    $smtm_cap_1 -> execute();
                
                }
                
                // Validacion de la segunda capacitacion donde los campos se encuentren completos
                if (($lug_capaci_2 !== "") && ($lug_capacita_2 !== "") && ($fech_capacita_2 !== "")) {

                    // Insercion en la base de datos de los campos de datos que se encuentran en el front de la segunda capacitacion
                    $query_cap_2 =("INSERT INTO capacitaciones (numero_doc,lugar,cod_cap,nom_cuapa,fec_cuapa,doc_cuapa)
                                    VALUES (:num_doc,:lug_capa,:cod_cap,:lug_capaci,:fec_capa,:doc_capa)");
                    $smtm_cap_2 = $conexion->prepare("$query_cap_2");
                    $smtm_cap_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_cap_2 -> bindParam(':lug_capa',$lug_capaci_2,PDO::PARAM_STR);
                    foreach ($inf_cc as $cc) {
                        if ($cc -> cod_cap == $lug_capacita_2) {
                            $cap = $cc -> capacitacion;
                            $smtm_cap_2 -> bindParam(':lug_capaci',$cap,PDO::PARAM_STR);
                        }
                    }
                    $smtm_cap_2 -> bindParam(':cod_cap',$lug_capacita_2,PDO::PARAM_STR);
                    $smtm_cap_2 -> bindParam(':fec_capa',$fech_capacita_2,PDO::PARAM_STR);
                    $smtm_cap_2 -> bindParam(':doc_capa',$rutaDocCap2,PDO::PARAM_STR);
                    $smtm_cap_2 -> execute();
                
                }
                
                // Validacion de la primera cualificacion donde los campos se encuentren completos
                if (($lug_cuali !== "") && ($lug_cualifica !== "") && ($fech_cualifi !== "")) {

                    // Insercion en la base de datos de los campos de datos que se encuentran en el front de la segunda cualificacion
                    $query_cual_1 =("INSERT INTO cualificaciones (numero_doc,lugar,cod_cuali,nom_cualifi,fec_cualifi,doc_cualifi)
                                    VALUES (:num_doc,:lug_cuali,:cod_cua,:lug_cualifica,:fec_cuali,:doc_culi)");
                    $smtm_cual_1 = $conexion->prepare("$query_cual_1");
                    $smtm_cual_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_cual_1 -> bindParam(':lug_cuali',$lug_cuali,PDO::PARAM_STR);
                    foreach ($inf_cu as $cu) {
                        if ($cu -> cod_cuali == $lug_cualifica) {
                            $cua = $cu -> cualificacion;
                            $smtm_cual_1 -> bindParam(':lug_cualifica',$cua,PDO::PARAM_STR);
                        }
                    }
                    $smtm_cual_1 -> bindParam(':cod_cua',$lug_cualifica,PDO::PARAM_STR);
                    $smtm_cual_1 -> bindParam(':fec_cuali',$fech_cualifi,PDO::PARAM_STR);
                    $smtm_cual_1 -> bindParam(':doc_culi',$rutaDocCua,PDO::PARAM_STR);
                    $smtm_cual_1 -> execute();

                }

                // Validacion de la segunda cualificacion donde los campos se encuentren completos
                if (($lug_cuali_2 !== "") && ($lug_cualifica_2 !== "") && ($fech_cualifi_2 !== "")) {

                    // Insercion en la base de datos de los campos de datos que se encuentran en el front de la segunda cualificacion
                    $query_cual_2 =("INSERT INTO cualificaciones (numero_doc,lugar,cod_cuali,nom_cualifi,fec_cualifi,doc_cualifi)
                                    VALUES (:num_doc,:lug_cuali_2,:cod_cua_2,:lug_cualifica_2,:fec_cuali_2,:doc_culi_2)");
                    $smtm_cual_2 = $conexion->prepare("$query_cual_2");
                    $smtm_cual_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_cual_2 -> bindParam(':lug_cuali_2',$lug_cuali_2,PDO::PARAM_STR);
                    foreach ($inf_cu as $cu) {
                        if ($cu -> cod_cuali == $lug_cualifica_2) {
                            $cua = $cu -> cualificacion;
                            $smtm_cual_2 -> bindParam(':lug_cualifica_2',$cua,PDO::PARAM_STR);
                        }
                    }
                    $smtm_cual_2 -> bindParam(':cod_cua_2',$lug_cualifica_2,PDO::PARAM_STR);
                    $smtm_cual_2 -> bindParam(':fec_cuali_2',$fech_cualifi_2,PDO::PARAM_STR);
                    $smtm_cual_2 -> bindParam(':doc_culi_2',$rutaDocCua2,PDO::PARAM_STR);
                    $smtm_cual_2 -> execute();

                }

                // Validacion de la primera referencia personal donde los campos se encuentren completos
                if (($nomb_ref !== "") && ($ape_ref !== "") && ($cel_ref !== "") && ($car_ref !== "")) {

                    // Insercion en la base de datos de los campos de le priemra referencia personal de los que estan en el front
                    $query_rp_1 =("INSERT INTO ref_personal (numero_doc,nom_ref_per,ape_ref_per,telefono_ref,cargo)
                                    VALUES (:num_doc,:nom_ref,:ape_ref,:cel_ref,:car_ref)");
                    $smtm_rp_1 = $conexion->prepare("$query_rp_1");
                    $smtm_rp_1 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_rp_1 -> bindParam(':nom_ref',$nomb_ref,PDO::PARAM_STR);
                    $smtm_rp_1 -> bindParam(':ape_ref',$ape_ref,PDO::PARAM_STR);
                    $smtm_rp_1 -> bindParam(':cel_ref',$cel_ref,PDO::PARAM_STR);
                    $smtm_rp_1 -> bindParam(':car_ref',$car_ref,PDO::PARAM_STR);
                    $smtm_rp_1 -> execute();
                    
                }

                // Validacion de la segunda referencia personal donde los campos se encuentren completos
                if (($nomb_ref_2 !== "") && ($ape_ref_2 !== "") && ($cel_ref_2 !== "") && ($car_ref_2 !== "")) {

                    // Insercion en la base de datos de los campos de le segunda referencia personal de los que estan en el front
                    $query_rp_2 =("INSERT INTO ref_personal (numero_doc,nom_ref_per,ape_ref_per,telefono_ref,cargo)
                                    VALUES (:num_doc,:nom_ref_2,:ape_ref_2,:cel_ref_2,:car_ref_2)");
                    $smtm_rp_2 = $conexion->prepare("$query_rp_2");
                    $smtm_rp_2 -> bindParam(':num_doc',$cedula_de_ciudadania,PDO::PARAM_STR);
                    $smtm_rp_2 -> bindParam(':nom_ref_2',$nomb_ref_2,PDO::PARAM_STR);
                    $smtm_rp_2 -> bindParam(':ape_ref_2',$ape_ref_2,PDO::PARAM_STR);
                    $smtm_rp_2 -> bindParam(':cel_ref_2',$cel_ref_2,PDO::PARAM_STR);
                    $smtm_rp_2 -> bindParam(':car_ref_2',$car_ref_2,PDO::PARAM_STR);
                    $smtm_rp_2 -> execute();
                }
                
                // Meter en el array cont las respuestas correspondientes para la interaccion con el DOM
                $cont['mensaje'] = "Inserción exitosa";
                $cont['url'] = "../pages/login.php";
                $cont['checkNo'] = $checkNo;

            } catch (PDOException $e) {

                // Acceder a la información del error
                $error_code = $e->getCode(); // Código de error
                $error_message = $e->getMessage(); // Mensaje de error

                // Información detallada del error
                // $error_info = $e->errorInfo();

                // Formatear el mensaje de error
                $error_description = 'Error: ' . $error_message . ' (Code: ' . $error_code . ')';
                
                // Puedes agregar más detalles, como el código de error específico de la base de datos
                // Por ejemplo, para MySQL, $error_info[1] contendría el código de error SQLSTATE

                // Puedes agregar este mensaje de error formateado a tu respuesta
                $cont['error'] = $error_description;

            }

            echo json_encode($cont);

        }
    }
}
?>