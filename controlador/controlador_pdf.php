<?php

    session_start();
    $cont = [];
    include_once("../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
    $ruta = $_POST["ruta"];
    $output_file_name = $ruta.str_replace('.', '-'.$usuario.'.', $template);
    $filepdf1 = str_replace('.docx', '.pdf', $output_file_name);
    $filepdf = str_replace($ruta, $ruta, $filepdf1);

    if ($save_as==='') {
        $TBS->Show(OPENTBS_FILE, $output_file_name);
        $exec = '"C:/Program Files/LibreOffice/program/soffice.bin" --invisible --convert-to pdf --outdir ' . escapeshellarg($ruta) . ' ' . escapeshellarg($output_file_name);
        shell_exec($exec);
    }

    $response = array(['type' => 'pdf', 'file' => "$filepdf"]);
    echo json_encode($response);

?>