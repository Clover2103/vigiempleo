<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $user = $_SESSION["num_doc"];

    $lug_cuali                   = $_POST["lug_cuali_2_pn"];
    $lug_cualifica               = $_POST["lug_cualifica_2_pn"];
    $fech_cualifi                = $_POST["fech_cualifi_2_pn"];
    
    $targetCua2 = "../../documents/cualificaciones/$user/";

    if (!file_exists($targetCua2)){
        mkdir($targetCua2,0755,true); 
        echo("Entre aqui pues papa cualificaciones dos");
    }

    if(isset($_FILES['doc_cualifi_2_pn']["name"])){
        $file_name = $_FILES['doc_cualifi_2_pn']["name"];
        
        $extension = pathinfo($_FILES['doc_cualifi_2_pn']["name"],PATHINFO_EXTENSION);
        
        $file_name = $user.'-'.'doc2'.'.'.$extension;
        $add = $targetCua2 . $file_name;
        
        $rutaDocCua2 = "../documents/cualificaciones/$user/$file_name";
        
        if(move_uploaded_file($_FILES['doc_cualifi_2_pn']["tmp_name"],$add)){}
    
    }

    try {
        $query =("INSERT INTO cualificaciones (numero_doc,lugar,nom_cualifi,fec_cualifi,doc_cualifi)
            VALUES (:num_doc,:lug_cuali,:lug_cualifica,:fec_cuali,:doc_culi)");
        $insert = $conexion->prepare("$query");
        $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
        $insert -> bindParam(':lug_cuali',$lug_cuali,PDO::PARAM_STR);
        $insert -> bindParam(':lug_cualifica',$lug_cualifica,PDO::PARAM_STR);
        $insert -> bindParam(':fec_cuali',$fech_cualifi,PDO::PARAM_STR);
        $insert -> bindParam(':doc_culi',$rutaDocCua2,PDO::PARAM_STR);
        $insert -> execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}
?>