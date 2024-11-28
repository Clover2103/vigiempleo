<?php

    session_start();
    $cont = [];
    include_once("../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    include_once("../tbs_3140/tbs_class.php");
    include_once("../tbs_3140/plugins/tbs_plugin_opentbs.php");

    $usuario = $_SESSION["num_doc"];

    $query = "SELECT * FROM usuario_natural WHERE numero_doc = :user_n";
    $stmt_un = $conexion->prepare("$query");
    $stmt_un->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_un->execute();
    $ins_un = $stmt_un->fetchAll(PDO::FETCH_OBJ);

    $query = "SELECT cu.*, mp.municipio FROM cont_usuario cu, municipio mp WHERE numero_doc = :user_n AND mp.cod_mun = cu.municipio";
    $stmt_cu = $conexion->prepare("$query");
    $stmt_cu->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_cu->execute();
    $ins_cont = $stmt_cu->fetchAll(PDO::FETCH_OBJ);

    $query = "SELECT * FROM ref_laboral WHERE numero_doc = :user_n";
    $stmt_rl = $conexion->prepare("$query");
    $stmt_rl->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_rl->execute();
    $ins_re_lab = $stmt_rl->fetchAll(PDO::FETCH_OBJ);

    $query = "SELECT * FROM estudios WHERE numero_doc = :user_n";
    $stmt_ea = $conexion->prepare("$query");
    $stmt_ea->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_ea->execute();
    $estudios = $stmt_ea->fetchAll(PDO::FETCH_OBJ);

    $query = "SELECT * FROM capacitaciones WHERE numero_doc = :user_n";
    $stmt_cp = $conexion->prepare("$query");
    $stmt_cp->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_cp->execute();
    $ins_cap = $stmt_cp->fetchAll(PDO::FETCH_OBJ);

    $query = "SELECT * FROM cualificaciones WHERE numero_doc = :user_n";
    $stmt_cl = $conexion->prepare("$query");
    $stmt_cl->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_cl->execute();
    $ins_cua = $stmt_cl->fetchAll(PDO::FETCH_OBJ);

    $query = "SELECT * FROM ref_personal WHERE numero_doc = :user_n";
    $stmt_rp = $conexion->prepare("$query");
    $stmt_rp->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_rp->execute();
    $ins_rp = $stmt_rp->fetchAll(PDO::FETCH_OBJ);
    
    $query = "SELECT * FROM otro_estudios WHERE numero_doc = :user_n";
    $stmt_oe = $conexion->prepare("$query");
    $stmt_oe->bindParam(':user_n',$usuario, PDO::PARAM_STR);
    $stmt_oe->execute();
    $ins_oe = $stmt_oe->fetchAll(PDO::FETCH_OBJ);

    $nom_com                = $ins_un[0] -> primer_nombre . " " . $ins_un[0] -> segundo_nombre . " " . $ins_un[0] -> primer_apellido . " " . $ins_un[0] -> segundo_apellido;
    $tip_doc                = $ins_un[0] -> tipo_doc;
    $num_doc                = $ins_un[0] -> numero_doc;
    $fec_nac                = $ins_un[0] -> fecha_nacimiento;
    $sexo                   = $ins_un[0] -> sexo;
    $etnia                  = $ins_un[0] -> ednia;
    $lic_con                = $ins_un[0] -> licencia;
    $num_licencia           = $ins_un[0] -> num_licencia;
    $cate_lic               = $ins_un[0] -> cate_lic;
    $cate_lic               = $cate_lic == 'null' ? $cate_lic = 'Ninguna' : "";
    $lib_mil                = $ins_un[0] -> libreta;
    $num_lib                = $ins_un[0] -> num_libreta;
    $foto                   = $ins_un[0] -> foto;
    $descrip                = $ins_un[0] -> descripcion;

    $celular                = $ins_cont[0] -> telefono;
    $municipio              = $ins_cont[0] -> municipio;
    $direccion              = $ins_cont[0] -> direccion;
    $correo                 = $ins_cont[0] -> correo;

    $nom_empresa            = isset($ins_re_lab[0]) ? $ins_re_lab[0]->nom_empresa : "";
    $cargo                  = isset($ins_re_lab[0]) ? $ins_re_lab[0]->cargo : "";
    $tie_ingreso            = isset($ins_re_lab[0]) ? $ins_re_lab[0]->tie_ingreso : "";
    $tie_salida             = isset($ins_re_lab[0]) ? $ins_re_lab[0]->tie_salida : "";
    $timestamp_ingreso      = isset($ins_re_lab[0]) ? strtotime($tie_ingreso) : 0;
    $timestamp_salida       = isset($ins_re_lab[0]) ? strtotime($tie_salida) : 0;
    $diff_seconds           = isset($ins_re_lab[0]) ? $timestamp_salida - $timestamp_ingreso : 0;
    $diff_months            = isset($ins_re_lab[0]) ? floor($diff_seconds / (30 * 24 * 60 * 60)) : 0;
    $jefe_inmediato         = isset($ins_re_lab[0]) ? $ins_re_lab[0]->jefe_inmediato : "";
    $tele_jefe              = isset($ins_re_lab[0]) ? $ins_re_lab[0]->tele_jefe : "";

    $nom_empresa_2          = isset($ins_re_lab[1]) ? $ins_re_lab[1]->nom_empresa : "";
    $cargo_2                = isset($ins_re_lab[1]) ? $ins_re_lab[1]->cargo : "";
    $tie_ingreso_2          = isset($ins_re_lab[1]) ? $ins_re_lab[1]->tie_ingreso : "";
    $tie_salida_2           = isset($ins_re_lab[1]) ? $ins_re_lab[1]->tie_salida : "";
    $timestamp_ingreso_2    = isset($ins_re_lab[1]) ? strtotime($tie_ingreso_2) : 0;
    $timestamp_salida_2     = isset($ins_re_lab[1]) ? strtotime($tie_salida_2) : 0;
    $diff_seconds_2         = isset($ins_re_lab[1]) ? $timestamp_salida_2 - $timestamp_ingreso_2 : 0;
    $diff_months_2          = isset($ins_re_lab[1]) ? floor($diff_seconds_2 / (30 * 24 * 60 * 60)) : 0;
    $jefe_inmediato_2       = isset($ins_re_lab[1]) ? $ins_re_lab[1]->jefe_inmediato : "";
    $tele_jefe_2            = isset($ins_re_lab[1]) ? $ins_re_lab[1]->tele_jefe : "";
    
    $nom_insti              = isset($estudios[0]) ? $estudios[0]->nom_insti : "";
    $nivel_aca              = isset($estudios[0]) ? $estudios[0]->nivel_aca : "TITULO";
    $titulo                 = isset($estudios[0]) ? $estudios[0]->titulo : "";
    $fec_fin                = isset($estudios[0]) ? $estudios[0]->fec_fin : "";

    $nom_insti_2            = isset($estudios[1]) ? $estudios[1]->nom_insti : "";
    $nivel_aca_2            = isset($estudios[1]) ? $estudios[1]->nivel_aca : "TITULO";
    $titulo_2               = isset($estudios[1]) ? $estudios[1]->titulo : "";
    $fec_fin_2              = isset($estudios[1]) ? $estudios[1]->fec_fin : "";

    $lugar                  = isset($ins_cap[0]) ? $ins_cap[0]->lugar : "";
    $nom_cuapa              = isset($ins_cap[0]) ? $ins_cap[0]->nom_cuapa : "TITULO";
    $fec_cuapa              = isset($ins_cap[0]) ? $ins_cap[0]->fec_cuapa : "";

    $lugar_2                = isset($ins_cap[1]) ? $ins_cap[1]->lugar : "";
    $nom_cuapa_2            = isset($ins_cap[1]) ? $ins_cap[1]->nom_cuapa : "TITULO";
    $fec_cuapa_2            = isset($ins_cap[1]) ? $ins_cap[1]->fec_cuapa : "";

    $lugar_cua              = isset($ins_cua[0]) ? $ins_cua[0]->lugar : "";
    $nom_cualifi            = isset($ins_cua[0]) ? $ins_cua[0]->nom_cualifi : "TITULO";
    $fec_cualifi            = isset($ins_cua[0]) ? $ins_cua[0]->fec_cualifi : "";

    $lugar_cua_2            = isset($ins_cua[1]) ? $ins_cua[1]->lugar : "";
    $nom_cualifi_2          = isset($ins_cua[1]) ? $ins_cua[1]->nom_cualifi : "TITULO";
    $fec_cualifi_2          = isset($ins_cua[1]) ? $ins_cua[1]->fec_cualifi : "";

    $nivel_ins_otro         = isset($ins_oe[0]) ? $ins_oe[0]->nivel_ins_otro : "";
    $titulo_otro            = isset($ins_oe[0]) ? $ins_oe[0]->titulo_otro : "TITULO";
    $fec_fin_otro           = isset($ins_oe[0]) ? $ins_oe[0]->fec_fin_otro : "";

    $nivel_ins_otro_2       = isset($ins_oe[1]) ? $ins_oe[1]->nivel_ins_otro : "";
    $titulo_otro_dos        = isset($ins_oe[1]) ? $ins_oe[1]->titulo_otro : "TITULO";
    $fec_fin_otro_2         = isset($ins_oe[1]) ? $ins_oe[1]->fec_fin_otro : "";

    $nom_com_rp             = isset($ins_rp[0]) ? $ins_rp[0]->nom_ref_per . ' ' . $ins_rp[0]->ape_ref_per : "";
    $telefono_ref           = isset($ins_rp[0]) ? $ins_rp[0]->telefono_ref : "";
    $cargo_ref              = isset($ins_rp[0]) ? $ins_rp[0]->cargo : "";

    $nom_com_rp_2           = isset($ins_rp[1]) ? $ins_rp[1]->nom_ref_per . ' ' . $ins_rp[1]->ape_ref_per : "";
    $telefono_ref_2         = isset($ins_rp[1]) ? $ins_rp[1]->telefono_ref : "";
    $cargo_ref_2            = isset($ins_rp[1]) ? $ins_rp[1]->cargo : "";

    $template = "plantilla_hv.docx";
    $ruta_t = "../plantillas/hv/" . $template;

    $TBS = new clsTinyButStrong;
    $TBS -> Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
    $TBS->LoadTemplate($ruta_t, OPENTBS_ALREADY_UTF8);

    $TBS->MergeField('pro.nom_com', $nom_com);
    $TBS->MergeField('pro.tip_doc', $tip_doc);
    $TBS->MergeField('pro.num_doc', $num_doc);
    $TBS->MergeField('pro.fec_nac', $fec_nac);
    $TBS->MergeField('pro.etnia', $etnia);
    $TBS->MergeField('pro.lic_con', $lic_con);
    $TBS->MergeField('pro.num_licencia', $num_licencia);
    $TBS->MergeField('pro.cate_lic', $cate_lic);
    $TBS->MergeField('pro.lib_mil', $lib_mil);
    $TBS->MergeField('pro.num_lib', $num_lib);
    $TBS->MergeField('pro.descrip', $descrip);

    $TBS->MergeField('pro.celular', $celular);
    $TBS->MergeField('pro.municipio', $municipio);
    $TBS->MergeField('pro.direccion', $direccion);
    $TBS->MergeField('pro.correo', $correo);

    $TBS->MergeField('pro.nom_empresa', $nom_empresa);
    $TBS->MergeField('pro.cargo', $cargo);
    $TBS->MergeField('pro.diff_months', $diff_months);
    $TBS->MergeField('pro.jefe_inmediato', $jefe_inmediato);
    $TBS->MergeField('pro.tele_jefe', $tele_jefe);

    $TBS->MergeField('pro.nom_empresa_2', $nom_empresa_2);
    $TBS->MergeField('pro.cargo_2', $cargo_2);
    $TBS->MergeField('pro.diff_months_2', $diff_months_2);
    $TBS->MergeField('pro.jefe_inmediato_2', $jefe_inmediato_2);
    $TBS->MergeField('pro.tele_jefe_2', $tele_jefe_2);

    $TBS->MergeField('pro.nom_insti', $nom_insti);
    $TBS->MergeField('pro.nivel_aca', $nivel_aca);
    $TBS->MergeField('pro.titulo', $titulo);
    $TBS->MergeField('pro.fec_fin', $fec_fin);

    $TBS->MergeField('pro.nom_insti_2', $nom_insti_2);
    $TBS->MergeField('pro.nivel_aca_2', $nivel_aca_2);
    $TBS->MergeField('pro.titulo_2', $titulo_2);
    $TBS->MergeField('pro.fec_fin_2', $fec_fin_2);

    $TBS->MergeField('pro.lugar', $lugar);
    $TBS->MergeField('pro.nom_cuapa', $nom_cuapa);
    $TBS->MergeField('pro.fec_cuapa', $fec_cuapa);

    $TBS->MergeField('pro.lugar_2', $lugar_2);
    $TBS->MergeField('pro.nom_cuapa_2', $nom_cuapa_2);
    $TBS->MergeField('pro.fec_cuapa_2', $fec_cuapa_2);

    $TBS->MergeField('pro.lugar_cua', $lugar_cua);
    $TBS->MergeField('pro.nom_cualifi', $nom_cualifi);
    $TBS->MergeField('pro.fec_cualifi', $fec_cualifi);

    $TBS->MergeField('pro.lugar_cua_2', $lugar_cua_2);
    $TBS->MergeField('pro.nom_cualifi_2', $nom_cualifi_2);
    $TBS->MergeField('pro.fec_cualifi_2', $fec_cualifi_2);

    $TBS->MergeField('pro.nivel_ins_otro', $nivel_ins_otro);
    $TBS->MergeField('pro.titulo_otro', $titulo_otro);
    $TBS->MergeField('pro.fec_fin_otro', $fec_fin_otro);

    $TBS->MergeField('pro.nivel_ins_otro_2', $nivel_ins_otro_2);
    $TBS->MergeField('pro.titulo_otro_dos', $titulo_otro_dos);
    $TBS->MergeField('pro.fec_fin_otro_2', $fec_fin_otro_2);

    $TBS->MergeField('pro.nom_com_rp', $nom_com_rp);
    $TBS->MergeField('pro.telefono_ref', $telefono_ref);
    $TBS->MergeField('pro.cargo_ref', $cargo_ref);

    $TBS->MergeField('pro.nom_com_rp_2', $nom_com_rp_2);
    $TBS->MergeField('pro.telefono_ref_2', $telefono_ref_2);
    $TBS->MergeField('pro.cargo_ref_2', $cargo_ref_2);

    $TBS->VarRef['x'] = realpath($foto);
    $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

    $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
    $ruta = "../plantillas/hv-pdf/";
    $output_file_name = $ruta.str_replace('.', '-'.$usuario.'.', $template);
    $filepdf1 = str_replace('.docx', '.pdf', $output_file_name);
    $filepdf = str_replace($ruta, $ruta, $filepdf1);

	if ($save_as==='') {
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		$exec = '/usr/bin/libreoffice7.1 --headless --convert-to pdf --outdir ' . escapeshellarg($ruta) . ' ' . escapeshellarg($output_file_name);
				shell_exec($exec);
            }

    //if ($save_as==='') {
        //$TBS->Show(OPENTBS_FILE, $output_file_name);
        //$exec = '"C:/Program Files/LibreOffice/program/soffice.bin" --invisible --convert-to pdf --outdir ' . escapeshellarg($ruta) . ' ' . escapeshellarg($output_file_name);
        //shell_exec($exec);
    //}

    $response = array(['type' => 'pdf', 'file' => "$filepdf"]);
    echo json_encode($response);

?>
