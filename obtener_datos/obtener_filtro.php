<?php

	// Establece el encabezado de tipo de contenido a JSON
	header('Content-Type: application/json');
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    use PhpOffice\PhpSpreadsheet\{Spreadsheet,IOFactory};
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;

	require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

    set_time_limit(900); // Establece el límite de tiempo a 300 segundos (15 minutos)

    $conn = [];
    include_once("../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $categories =           ['A1', 'A2', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3'];
    $formacion =            ['01','02','03','04','05','06','07','08','09','10','11','12'];
    $capacitacion =         [
                                '01' => ['01','02','03','04'],
                                '02' => ['05','06','07','08'],
                                '03' => ['09','10','11','12'],
                                '04' => ['13','14','15','16'],
                                '05' => ['17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38'],
                                '06' => []
                            ];

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


        // Encuentra el índice correspondiente
        $indice = null;
        foreach ($capacitacion as $key => $grupo) {
            if (in_array($cargo, $grupo)) {
                $indice = $key;
                break;
            }
        }


        $query = "SELECT un.numero_doc FROM usuario_natural un ";
        if (isset($cargo) || isset($edad_menor) || isset($edad_mayor) || isset($departamento) || isset($municipios) || isset($posee_lib) || isset($posee_lic) || isset($cate_lic) || isset($sexo) || isset($ednia) || isset($tiempo_exp) || isset($capacitacion) || isset($cualificacion) || isset($nivel_aca)) {
            
            $query .= ($departamento !== "" && $municipios !== "") ? "LEFT JOIN cont_usuario cu ON un.numero_doc = cu.numero_doc " : "" ;
            $query .= ($tiempo_exp !== "") ? "LEFT JOIN ref_laboral rl ON un.numero_doc = rl.numero_doc " : "" ;
            $query .= ($cargo !== "") ? "LEFT JOIN capacitaciones ca ON un.numero_doc = ca.numero_doc " : "" ;
            // $query .= ($capacitacion !== "") ? "LEFT JOIN capacitaciones ca ON un.numero_doc = ca.numero_doc " : "" ;
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
            $query .= ((($nivel_aca !== "") && in_array($nivel_aca, $formacion)) ? "AND es.cod_na IN ('" . implode("', '", array_slice($formacion, 0, array_search($nivel_aca, $formacion) + 1)) . "') " : "");
            if ($cargo !== null) {
                $query .= " AND EXISTS (SELECT 1 FROM capacitaciones ca WHERE ca.numero_doc = un.numero_doc AND ca.cod_cap IN ('" . implode("','", $capacitacion[$cargo]) . "'))";
            }        
            // $query .= $cargo !== "" ? "AND ca.cod_cargo IN ('" . implode("', '", $capacitacion[$cargo]) . "') " : "";
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
		

        for ($i = 0; $i < $usuarios; $i++) {
            
            $usuario = $array[$i]['numero_doc'];
			
            $x = $i + 4;

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

            $celular                = isset($ins_cont[0]) ? $ins_cont[0]->telefono ?? 'Dato no disponible' : 'Dato no disponible';
            $municipio              = isset($ins_cont[0]) ? $ins_cont[0]->municipio ?? 'Dato no disponible' : 'Dato no disponible';
            $direccion              = isset($ins_cont[0]) ? $ins_cont[0]->direccion ?? 'Dato no disponible' : 'Dato no disponible';
            $correo                 = isset($ins_cont[0]) ? $ins_cont[0]->correo ?? 'Dato no disponible' : 'Dato no disponible';

            $cargo                  = isset($ins_re_lab[0]) ? $ins_re_lab[0]->cargo : "";
            $tie_ingreso            = isset($ins_re_lab[0]) ? $ins_re_lab[0]->tie_ingreso : "";
            $tie_salida             = isset($ins_re_lab[0]) ? $ins_re_lab[0]->tie_salida : "";

            // Verificación adicional para evitar pasar null a strtotime
            $timestamp_ingreso      = !empty($tie_ingreso) ? strtotime($tie_ingreso) : 0;
            $timestamp_salida       = !empty($tie_salida) ? strtotime($tie_salida) : 0;

            $diff_seconds           = ($timestamp_salida && $timestamp_ingreso) ? $timestamp_salida - $timestamp_ingreso : 0;
            $diff_months            = $diff_seconds ? floor($diff_seconds / (30 * 24 * 60 * 60)) : 0;

            $cargo_2                = isset($ins_re_lab[1]) ? $ins_re_lab[1]->cargo : "";
            $tie_ingreso_2          = isset($ins_re_lab[1]) ? $ins_re_lab[1]->tie_ingreso : "";
            $tie_salida_2           = isset($ins_re_lab[1]) ? $ins_re_lab[1]->tie_salida : "";

            // Verificación adicional para evitar pasar null a strtotime
            $timestamp_ingreso_2    = !empty($tie_ingreso_2) ? strtotime($tie_ingreso_2) : 0;
            $timestamp_salida_2     = !empty($tie_salida_2) ? strtotime($tie_salida_2) : 0;

            $diff_seconds_2         = ($timestamp_salida_2 && $timestamp_ingreso_2) ? $timestamp_salida_2 - $timestamp_ingreso_2 : 0;
            $diff_months_2          = $diff_seconds_2 ? floor($diff_seconds_2 / (30 * 24 * 60 * 60)) : 0;

            $nom_cuapa              = isset($ins_cap[0]) ? $ins_cap[0]->nom_cuapa : "TITULO";
            $fec_cuapa              = isset($ins_cap[0]) ? $ins_cap[0]->fec_cuapa : "";

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

        }

        // Crear un flujo de memoria temporal
		$excelStream = fopen('php://temp', 'r+');
		$writer->save($excelStream); // Guardar el Excel en el flujo
		rewind($excelStream); // Volver al inicio del flujo

		// Leer el contenido del flujo
		$fileContents = stream_get_contents($excelStream);

		fclose($excelStream); // Cerrar el flujo

		// Convertir a base64
		$base64 = base64_encode($fileContents);

		// Devolver la respuesta
		$response = [
			'status' => 'success',
			'message' => 'Excel generado correctamente',
			'excel' => $base64
		];

    } else {
        $conn["error"] = "f";
    }

    if ($insert->rowCount() == 0) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        $conn["fallo"] = "*** No se encuentra personal con los parametros seleccionados ***";
    }

	header('Content-Type: application/json');
	echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
	exit;

	//echo json_encode($response);
    //echo json_encode($conn);
?>