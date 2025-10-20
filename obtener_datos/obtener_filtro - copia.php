<?php

    use PhpOffice\PhpSpreadsheet\{Spreadsheet,IOFactory};
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;

    set_time_limit(900); // Establece el límite de tiempo a 300 segundos (15 minutos)

    $conn = [];
    include_once("../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    require("../vendor/autoload.php");
    include_once("../tbs_3140/tbs_class.php");
    include_once("../tbs_3140/plugins/tbs_plugin_opentbs.php");

    $categories =           ['A1', 'A2', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3'];
    $formacion =            ['01','02','03','04','05','06','07','08','09','10','11','12'];
    $capacitacion =         ["01","02","03","04","05","06"];

    $edad_menor =           $_POST["edad_menor"] !== "--"    ? $_POST["edad_menor"]      : "" ;
    $edad_mayor =           $_POST["edad_mayor"] !== "--"    ? $_POST["edad_mayor"]      : "" ;
    $ednia =                $_POST["ednia"] !== "--"         ? $_POST["ednia"]           : "" ;
    $sexo =                 $_POST["sexo"] !== "--"          ? $_POST["sexo"]            : "" ;
    $departamento =         $_POST["departamento"] !== "--"  ? $_POST["departamento"]    : "" ;
    $municipios =           $_POST["municipios"] !== "--"    ? $_POST["municipios"]      : "" ;
    $posee_lib =            $_POST["posee_lib"] !== "--"     ? $_POST["posee_lib"]       : "" ;
    $posee_lic =            $_POST["posee_lic"] !== "--"     ? $_POST["posee_lic"]       : "" ;
    $cate_lic =             $_POST["cate_lic"] !== "--"      ? $_POST["cate_lic"]        : "" ;
    $cargo =                $_POST["cargo"]  !== "--"        ? $_POST["cargo"]           : "" ;
    $tiempo_exp =           $_POST["tiempo_exp"] !== ""      ? $_POST["tiempo_exp"]      : "" ;
    $nivel_aca =            $_POST["nivel_aca"] !== "--"     ? $_POST["nivel_aca"]       : "" ;
    $cualificacion =        $_POST["cualificacion"] !== "--" ? $_POST["cualificacion"]   : "" ;
    $cantidad =             $_POST["cantidad"] !== "--"      ? $_POST["cantidad"]        : "" ;
    $empresa =              $_POST["empresa"]  !== ""        ? $_POST["empresa"]         : "" ;

    $excel = new Spreadsheet();
    $writer = new Xlsx($excel);
    $excel->getProperties()->setCreator("Vigiempleo.com")->setTitle("Reclutamento personala " . $empresa);
    $excel->setActiveSheetIndex(0);
    $hojaActiva = $excel->getActiveSheet();

    // Combinar celdas para crear un encabezado
    $hojaActiva->mergeCells('B2:T2');

    // Establecer contenido y estilo al encabezado combinado
    $hojaActiva->setCellValue('B2', 'BASE DE DATOS FORMATO VIGIEMPLEO DE ASPIRANTES PARA : ' . $empresa);
    // Alinear al centro vertical y horizontal en una celda específica
    $hojaActiva->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $hojaActiva->getStyle('B2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $hojaActiva->getStyle('B3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $hojaActiva->getStyle('B3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $hojaActiva->setShowGridlines(false);
    $hojaActiva->getRowDimension(2)->setRowHeight(45);
    $hojaActiva->getStyle('B2:T3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DDEBF7');
    $hojaActiva->getStyle('B2:T3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    $logoPath = '../img/login/logo vigiempleo.png';
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo de vigiempleo');
    $drawing->setPath($logoPath);
    $drawing->setCoordinates('C2');
    $drawing->setHeight(62);    
    $drawing->setWorksheet($hojaActiva);


    $hojaActiva->getColumnDimension('A')->setWidth(5);
    $hojaActiva->setCellValue('B3','#');
    $hojaActiva->getColumnDimension('B')->setWidth(4);
    $hojaActiva->setCellValue('C3','PRIMER NOMBRE');
    $hojaActiva->getColumnDimension('C')->setWidth(17);
    $hojaActiva->setCellValue('D3','SEGUNDO NOMBRE');
    $hojaActiva->getColumnDimension('D')->setWidth(17);
    $hojaActiva->setCellValue('E3','PRIMER APELLIDO');
    $hojaActiva->getColumnDimension('E')->setWidth(17);
    $hojaActiva->setCellValue('F3','SEGUNDO APELLIDO');
    $hojaActiva->getColumnDimension('F')->setWidth(18);
    $hojaActiva->setCellValue('G3','TIPO DOCUMENTO');
    $hojaActiva->getColumnDimension('G')->setWidth(17);
    $hojaActiva->setCellValue('H3','NUMERO DOCUMENTO');
    $hojaActiva->getColumnDimension('H')->setWidth(21);
    $hojaActiva->setCellValue('I3','FECHA NACIMIENTO');
    $hojaActiva->getColumnDimension('I')->setWidth(18);
    $hojaActiva->setCellValue('J3','EDAD');
    $hojaActiva->getColumnDimension('J')->setWidth(6);
    $hojaActiva->setCellValue('K3','CELULAR');
    $hojaActiva->getColumnDimension('K')->setWidth(12);
    $hojaActiva->setCellValue('L3','CORREO');
    $hojaActiva->getColumnDimension('L')->setWidth(32);
    $hojaActiva->setCellValue('M3','DIRECCION');
    $hojaActiva->getColumnDimension('M')->setWidth(35);
    $hojaActiva->setCellValue('N3','CIUDAD');
    $hojaActiva->getColumnDimension('N')->setWidth(13);
    $hojaActiva->setCellValue('O3','SEXO');
    $hojaActiva->getColumnDimension('O')->setWidth(12);
    $hojaActiva->setCellValue('P3','ETNIA');
    $hojaActiva->getColumnDimension('P')->setWidth(16);
    $hojaActiva->setCellValue('Q3','ULTIMO CARGO');
    $hojaActiva->getColumnDimension('Q')->setWidth(25);
    $hojaActiva->setCellValue('R3','TIEMPO DURACION (MESES)');
    $hojaActiva->getColumnDimension('R')->setWidth(26);
    $hojaActiva->setCellValue('S3','CAPACITACION');
    $hojaActiva->getColumnDimension('S')->setWidth(30);
    $hojaActiva->setCellValue('T3','TIEMPO CAPACITACION');
    $hojaActiva->getColumnDimension('T')->setWidth(23);

    try {
         $query = "SELECT un.numero_doc FROM usuario_natural un ";
        if (isset($cargo) || isset($edad_menor) || isset($edad_mayor) || isset($departamento) || isset($municipios) || isset($posee_lib) || isset($posee_lic) || isset($cate_lic) || isset($sexo) || isset($ednia) || isset($tiempo_exp) || isset($capacitacion) || isset($cualificacion) || isset($nivel_aca)) {
            
            $query .= ($departamento !== "" && $municipios !== "") ? "LEFT JOIN cont_usuario cu ON un.numero_doc = cu.numero_doc " : "" ;
            $query .= ($tiempo_exp !== "" || $cargo !== "") ? "LEFT JOIN ref_laboral rl ON un.numero_doc = rl.numero_doc " : "" ;
            $query .= ($nivel_aca !== "") ? "LEFT JOIN estudios es ON un.numero_doc = es.numero_doc " : "" ;
            $query .= ($cualificacion !== "") ? "LEFT JOIN cualificaciones cf ON un.numero_doc = cf.numero_doc " : "" ;
            $query .= "WHERE un.estado = 'desempleado' ";

            $query .= ((($edad_menor !== "") && ($edad_mayor !== "")) ? "AND un.edad >= :edad_menor AND un.edad <= :edad_mayor " : "");
            $query .= (($sexo !== "" ) ? ($sexo == "Ambos" ? "" : "AND un.sexo = :sexo ") : "");
            $query .= (($ednia !== "") ? "AND un.ednia = :ednia " : "");
            $query .= (($departamento !== "") ? "AND cu.departamento = :departamento " : "");
            $query .= (($municipios !== "") ? "AND cu.municipio = :municipios " : "");
            $query .= (($posee_lib !== "") ?  "AND un.libreta = :posee_lib " :"");
            if (($posee_lic !== "" ) && ($cate_lic !== "" ) && in_array($cate_lic, $categories)) {
                $selectedCatIndex = array_search($cate_lic, $categories);
                $selectedCategories = array_slice($categories, 0, $selectedCatIndex + 1);
                $query .= "AND un.licencia = :posee_lic AND cate_lic IN ('" . implode("', '", array_map('addslashes', $selectedCategories)) . "') ";
                // $query .= "AND un.licencia = :posee_lic AND cate_lic IN ('" . implode("', '", $selectedCategories) . "') ";
            }
            $query .= ($tiempo_exp !== "") ? "AND (rl.tie_ingreso IS NOT NULL AND rl.tie_salida IS NOT NULL AND TIMESTAMPDIFF(MONTH, rl.tie_ingreso, rl.tie_salida) >= :tiempo_exp) " : "";
            // $query .= (((!isset($nivel_aca) || $nivel_aca !== "--") && is_array($formacion) && in_array($nivel_aca, $formacion)) ? "AND es.nivel_aca IN ('" . implode("', '", array_slice($formacion, 0, array_search($nivel_aca, $formacion) + 1)) . "') " : "");
            $query .= ((($nivel_aca !== "") && in_array($nivel_aca, $formacion)) ? "AND es.cod_na IN ('" . implode("', '", array_slice($formacion, 0, array_search($nivel_aca, $formacion) + 1)) . "') " : "");
            $query .= $cargo !== "" ? "AND rl.cod_cargo IN ('" . implode("', '", $capacitacion[$cargo]) . "') " : "";
            $query .= ($cualificacion !== "" ? "AND cf.nom_cualifi = :cualificacion " : "");
            $query .= "GROUP BY RAND() ";
            $query .= ($cantidad !== "" ? "LIMIT :cantidad " : "");
			
        }
        



        $insert = $conexion->prepare($query);
        ($edad_menor !== "") ? $insert->bindValue(":edad_menor", intval($edad_menor), PDO::PARAM_INT) : null;
        ($edad_mayor !== "") ? $insert->bindValue(":edad_mayor", intval($edad_mayor), PDO::PARAM_INT) : null;
        ($sexo !== "") ? $insert->bindParam(":sexo", $sexo, PDO::PARAM_STR) : null;
        ($ednia !== "") ? $insert->bindParam(":ednia", $ednia, PDO::PARAM_STR) : null;
        ($departamento !== "") ? $insert->bindParam(":departamento", $departamento, PDO::PARAM_STR) : null;
        ($municipios !== "" ) ? $insert->bindParam(":municipios", $municipios, PDO::PARAM_STR) : null;
        ($posee_lib !== "") ? $insert->bindParam(":posee_lib", $posee_lib, PDO::PARAM_STR) : null;
        ($posee_lic !== "" ) ? $insert->bindParam(":posee_lic", $posee_lic, PDO::PARAM_STR) : null;
        ($tiempo_exp !== "") ? $insert->bindParam(":tiempo_exp", $tiempo_exp, PDO::PARAM_STR) : null;
        ($cualificacion !== "") ? $insert->bindParam(":cualificacion", $cualificacion, PDO::PARAM_STR) : null;
        ($cantidad !== "") ? $insert->bindValue(":cantidad", intval($cantidad), PDO::PARAM_INT) : null;
        $insert->execute();
        $array = $insert->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Surgio un error de modificacion' . $e->getMessage();
    }

    if ($insert->rowCount() > 0) {
        $usuarios = sizeof($array);
        date_default_timezone_set('America/Bogota');
        $hoy = getdate();
        $name = "Dia " . $hoy['mday'] . "-" . $hoy['mon'] . "-" . $hoy['year'] . " Hora " . $hoy['hours'] . "-" . $hoy['minutes'] . "-" . $hoy['seconds'];
        $userFolderUser = "../plantillas/hv-pdf-admin/usuarios pdf/" . $empresa . " " . $name . "/";
        if (!file_exists($userFolderUser)) {
            mkdir($userFolderUser, 0777, true);
        }
        for ($i = 0; $i < $usuarios; $i++) {
            
            $usuario = $array[$i]['numero_doc'];
            $userFolder = "../plantillas/hv-pdf-admin/usuarios pdf/"  . $empresa . " " . $name . '/' . $usuario . "/";
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0777, true);
            }

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
            $primer_nom             = $ins_un[0] -> primer_nombre;
            $segundo_nom            = $ins_un[0] -> segundo_nombre;
            $primer_ape             = $ins_un[0] -> primer_apellido;
            $segundo_ape            = $ins_un[0] -> segundo_apellido;
            $tip_doc                = $ins_un[0] -> tipo_doc;
            $num_doc                = $ins_un[0] -> numero_doc;
            $fec_nac                = $ins_un[0] -> fecha_nacimiento;
            $edad                   = $ins_un[0] -> edad;
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
            $ref_lab_doc            = isset($ins_re_lab[0]) ? $ins_re_lab[0]->comp_lab : "";

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
            $ref_lab_doc_2          = isset($ins_re_lab[1]) ? $ins_re_lab[1]->comp_lab : "";
            
            $nom_insti              = isset($estudios[0]) ? $estudios[0]->nom_insti : "";
            $nivel_aca              = isset($estudios[0]) ? $estudios[0]->nivel_aca : "TITULO";
            $titulo                 = isset($estudios[0]) ? $estudios[0]->titulo : "";
            $fec_fin                = isset($estudios[0]) ? $estudios[0]->fec_fin : "";
            $doc_est                = isset($estudios[0]) ? $estudios[0]->comp_est : "";

            $nom_insti_2            = isset($estudios[1]) ? $estudios[1]->nom_insti : "";
            $nivel_aca_2            = isset($estudios[1]) ? $estudios[1]->nivel_aca : "TITULO";
            $titulo_2               = isset($estudios[1]) ? $estudios[1]->titulo : "";
            $fec_fin_2              = isset($estudios[1]) ? $estudios[1]->fec_fin : "";
            $doc_est_2              = isset($estudios[1]) ? $estudios[1]->comp_est : "";

            $lugar                  = isset($ins_cap[0]) ? $ins_cap[0]->lugar : "";
            $nom_cuapa              = isset($ins_cap[0]) ? $ins_cap[0]->nom_cuapa : "TITULO";
            $fec_cuapa              = isset($ins_cap[0]) ? $ins_cap[0]->fec_cuapa : "";
            $doc_cuapa              = isset($ins_cap[0]) ? $ins_cap[0]->doc_cuapa : "";

            $lugar_2                = isset($ins_cap[1]) ? $ins_cap[1]->lugar : "";
            $nom_cuapa_2            = isset($ins_cap[1]) ? $ins_cap[1]->nom_cuapa : "TITULO";
            $fec_cuapa_2            = isset($ins_cap[1]) ? $ins_cap[1]->fec_cuapa : "";
            $doc_cuapa_2            = isset($ins_cap[1]) ? $ins_cap[1]->doc_cuapa : "";

            $lugar_cua              = isset($ins_cua[0]) ? $ins_cua[0]->lugar : "";
            $nom_cualifi            = isset($ins_cua[0]) ? $ins_cua[0]->nom_cualifi : "TITULO";
            $fec_cualifi            = isset($ins_cua[0]) ? $ins_cua[0]->fec_cualifi : "";
            $doc_cualifica          = isset($ins_cua[0]) ? $ins_cua[0]->doc_cualifi : "";

            $lugar_cua_2            = isset($ins_cua[1]) ? $ins_cua[1]->lugar : "";
            $nom_cualifi_2          = isset($ins_cua[1]) ? $ins_cua[1]->nom_cualifi : "TITULO";
            $fec_cualifi_2          = isset($ins_cua[1]) ? $ins_cua[1]->fec_cualifi : "";
            $doc_cualifica_2        = isset($ins_cua[1]) ? $ins_cua[1]->doc_cualifi : "";

            $nivel_ins_otro         = isset($ins_oe[0]) ? $ins_oe[0]->nivel_ins_otro : "";
            $titulo_otro            = isset($ins_oe[0]) ? $ins_oe[0]->titulo_otro : "TITULO";
            $fec_fin_otro           = isset($ins_oe[0]) ? $ins_oe[0]->fec_fin_otro : "";
            $doc_otro               = isset($ins_oe[0]) ? $ins_oe[0]->comp_otro : "";

            $nivel_ins_otro_2       = isset($ins_oe[1]) ? $ins_oe[1]->nivel_ins_otro : "";
            $titulo_otro_dos        = isset($ins_oe[1]) ? $ins_oe[1]->titulo_otro : "TITULO";
            $fec_fin_otro_2         = isset($ins_oe[1]) ? $ins_oe[1]->fec_fin_otro : "";
            $doc_otro_2             = isset($ins_oe[1]) ? $ins_oe[1]->comp_otro : "";

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
            $ruta = "../plantillas/hv-pdf-admin/usuarios word/";
            $output_file_name = $ruta.str_replace('plantilla_hv', 'Hoja de vida '. $num_doc , $template);
            $filepdf1 = str_replace('.docx', '.pdf', $output_file_name);
            $filepdf = str_replace('usuarios word', 'usuarios pdf', $filepdf1);

            $x = $i + 4;

            $hojaActiva->setCellValue('B' . $x, $i + 1);
            $hojaActiva->getStyle('B' . $x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DDEBF7');
            $hojaActiva->getStyle('B' . $x . ':' . 'T' . $x)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $hojaActiva->getStyle('B' . $x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $hojaActiva->getStyle('B' . $x)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $hojaActiva->setCellValue('C' . $x, $primer_nom);
            $hojaActiva->setCellValue('D' . $x, $segundo_nom);
            $hojaActiva->setCellValue('E' . $x, $primer_ape);
            $hojaActiva->setCellValue('F' . $x, $segundo_ape);
            $hojaActiva->setCellValue('G' . $x, $tip_doc);
            $hojaActiva->setCellValue('H' . $x, $num_doc);
            $hojaActiva->setCellValue('I' . $x, $fec_nac);
            $hojaActiva->setCellValue('J' . $x, $edad);
            $hojaActiva->setCellValue('K' . $x, $celular);
            $hojaActiva->setCellValue('L' . $x, $correo);
            $hojaActiva->setCellValue('M' . $x, $direccion);
            $hojaActiva->setCellValue('N' . $x, $municipio);
            $hojaActiva->setCellValue('O' . $x, $sexo);
            $hojaActiva->setCellValue('P' . $x, $etnia);
            $hojaActiva->setCellValue('Q' . $x, $cargo);
            $hojaActiva->setCellValue('R' . $x, $diff_months);
            $hojaActiva->setCellValue('S' . $x, $nom_cuapa == 'TITULO' ? $nom_cuapa = "" : $nom_cuapa);
            $hojaActiva->setCellValue('T' . $x, $fec_cuapa);

            if (!empty($doc_cuapa) && strtolower($doc_cuapa) !== "null") {
                if (substr($doc_cuapa, 0, 6) === "../../") {
                    $doc_cuapa = str_replace('../../','../',$doc_cuapa);
                }
                copy($doc_cuapa, $userFolder . basename(str_replace($usuario . '-doc', 'Capacitacion uno-' . $usuario, $doc_cuapa)));
            }

            if (!empty($doc_cuapa_2) && strtolower($doc_cuapa_2) !== "null") {
                if (substr($doc_cuapa_2, 0, 6) === "../../") {
                    $doc_cuapa_2 = str_replace('../../','../',$doc_cuapa_2);
                }
                copy($doc_cuapa_2, $userFolder . basename(str_replace($usuario . '-doc2', 'Capacitacion dos-' . $usuario, $doc_cuapa_2)));
            }

            if (!empty($ref_lab_doc) && strtolower($ref_lab_doc) !== "null") {
                if (substr($ref_lab_doc, 0, 6) === "../../") {
                    $ref_lab_doc = str_replace('../../','../',$ref_lab_doc);
                }
                copy($ref_lab_doc, $userFolder . basename(str_replace($usuario . '-ref_lab', 'Certificacion laboral uno-' . $usuario, $ref_lab_doc)));
            }

            if (!empty($ref_lab_doc_2) && strtolower($ref_lab_doc_2) !== "null") {
                if (substr($ref_lab_doc_2, 0, 6) === "../../") {
                    $ref_lab_doc_2 = str_replace('../../','../',$ref_lab_doc_2);
                }
                copy($ref_lab_doc_2, $userFolder . basename(str_replace($usuario . '-ref_lab2', 'Certificacion laboral dos-' . $usuario, $ref_lab_doc_2)));
            }

            if (!empty($doc_est) && strtolower($doc_est) !== "null") {
                if (substr($doc_est, 0, 6) === "../../") {
                    $doc_est = str_replace('../../','../',$doc_est);
                }
                copy($doc_est, $userFolder . basename(str_replace($usuario . '-est_for', 'Certificacion estudio uno-' . $usuario, $doc_est)));
            }

            if (!empty($doc_est_2) && strtolower($doc_est_2) !== "null") {
                if (substr($doc_est_2, 0, 6) === "../../") {
                    $doc_est_2 = str_replace('../../','../',$doc_est_2);
                }
                copy($doc_est_2, $userFolder . basename(str_replace($usuario . '-est_for2', 'Certificacion estudio dos-' . $usuario, $doc_est_2)));
            }

            if (!empty($doc_cualifica) && strtolower($doc_cualifica) !== "null") {
                if (substr($doc_cualifica, 0, 6) === "../../") {
                    $doc_cualifica = str_replace('../../','../',$doc_cualifica);
                }
                copy($doc_cualifica, $userFolder . basename(str_replace($usuario . '-doc', 'Certificacion cualificacion uno-' . $usuario, $doc_cualifica)));
            }

            if (!empty($doc_cualifica_2) && strtolower($doc_cualifica_2) !== "null") {
                if (substr($doc_cualifica_2, 0, 6) === "../../") {
                    $doc_cualifica_2 = str_replace('../../','../',$doc_cualifica_2);
                }
                copy($doc_cualifica_2, $userFolder . basename(str_replace($usuario . '-doc2', 'Certificacion cualificacion dos-' . $usuario, $doc_cualifica_2)));
            }

            if (!empty($doc_otro) && strtolower($doc_otro) !== "null") {
                if (substr($doc_otro, 0, 6) === "../../") {
                    $doc_otro = str_replace('../../','../',$doc_otro);
                }
                copy($doc_otro, $userFolder . basename(str_replace($usuario . '-otro', 'Cursos - Seminarios - Diplomados uno-' . $usuario, $doc_otro)));
            }

            if (!empty($doc_otro_2) && strtolower($doc_otro_2) !== "null") {
                if (substr($doc_otro_2, 0, 6) === "../../") {
                    $doc_otro_2 = str_replace('../../','../',$doc_otro_2);
                }
                copy($doc_otro_2, $userFolder . basename(str_replace($usuario . '-otro2', 'Cursos - Seminarios - Diplomados dos-' . $usuario, $doc_otro_2)));
            }

            if ($save_as==='') {
                $TBS->Show(OPENTBS_FILE, $output_file_name);
                $exec = '/usr/bin/libreoffice7.1 --headless --convert-to pdf --outdir ' . escapeshellarg($userFolder) . ' ' . escapeshellarg($output_file_name);
                shell_exec($exec);
            }

            $ruta_archivos[] = $filepdf;

        }

        $zip = new ZipArchive();
        $nombre_archivo_zip = "../plantillas/hv-pdf-admin/archivos-zip/Reclutamiento personal " . $empresa . " " . $name . ".zip";
        $carpeta = "Documentacion de personal";

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($userFolderUser, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        if ($zip->open($nombre_archivo_zip, ZipArchive::CREATE) === TRUE) {

            // Añadir un directorio vacío al archivo ZIP
            $zip->addEmptyDir($carpeta);

            // Crear el archivo Excel en el stream
            $excelStream = fopen('php://temp', 'r+');
            $writer->save($excelStream);
            rewind($excelStream); // Regresar al inicio del stream después de guardar

            // Agregar el archivo Excel al archivo ZIP
            $zip->addFromString('Reclutamento personal ' . $empresa . '.xlsx', stream_get_contents($excelStream));
            fclose($excelStream); // Cerrar el stream del archivo Excel

            // Recorrer y agregar archivos al ZIP
            foreach ($iterator as $file) {
                // Verificar si es un archivo válido
                if ($file->isFile()) {
                    // Obtener la ruta relativa del archivo
                    $relativePath = $iterator->getSubPathName();
                    // Agregar el archivo al archivo ZIP con la ruta relativa
                    $zip->addFile($file->getPathname(), $carpeta . '/' . $relativePath);
                }
            }

            $zip->close();

            $zipFilename = basename($nombre_archivo_zip);

            // Configurar encabezados para la descarga del archivo ZIP
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment;filename="' . $zipFilename . '"');
            header('Content-Length: ' . filesize($nombre_archivo_zip));

            $conn["zip"] = $nombre_archivo_zip;
            $conn["dwn"] = "si";
        } else {
            $conn["error"] = "f";
        }

        if ($insert->rowCount() == 0) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            $conn["fallo"] = "*** No se encuentra personal con los parametros seleccionados ***";
        }

        echo json_encode($conn);

    }
?>