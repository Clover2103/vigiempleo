<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $user = $_SESSION["num_doc"];

    $lug_capaci                   = $_POST["lug_capaci_2_pn"];
    $lug_capacita                 = $_POST["lug_capacita_2_pn"];
    $fech_capacita                = $_POST["fech_capacita_2_pn"];
    
    $targetCap = "../../documents/capacitaciones/$user/";

    if (!file_exists($targetCap)){
        mkdir($targetCap,0755,true);
        echo("Entre aqui pues papa primera cualificacion");
    }

    if(isset($_FILES['doc_capacita_2_pn']["name"])){
        $file_name = $_FILES['doc_capacita_2_pn']["name"];
        
        $extension = pathinfo($_FILES['doc_capacita_2_pn']["name"],PATHINFO_EXTENSION);
        
        $file_name = $user.'-'.'doc2'.'.'.$extension;
        $add = $targetCap . $file_name;

        $rutaDocCap = "../documents/capacitaciones/$user/$file_name";
        
        if(move_uploaded_file($_FILES['doc_capacita_2_pn']["tmp_name"],$add)){}
    
    }

    try {
        $query =("INSERT INTO capacitaciones (numero_doc,lugar,nom_cuapa,fec_cuapa,doc_cuapa)
            VALUES (:num_doc,:lug_cap,:lug_capa,:fech_cap,:doc_cap)");
        $insert = $conexion->prepare("$query");
        $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
        $insert -> bindParam(':lug_cap',$lug_capaci,PDO::PARAM_STR);
        $insert -> bindParam(':lug_capa',$lug_capacita,PDO::PARAM_STR);
        $insert -> bindParam(':fech_cap',$fech_capacita,PDO::PARAM_STR);
        $insert -> bindParam(':doc_cap',$rutaDocCap,PDO::PARAM_STR);
        $insert -> execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}
?>