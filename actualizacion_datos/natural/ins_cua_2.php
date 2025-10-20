<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $query = "SELECT * FROM ciclo_cualificacion";
    $smtm = $conexion->prepare($query);
    $smtm->execute();
    $inf_cu = $smtm->fetchAll(PDO::FETCH_OBJ);

    $user = $_SESSION["num_doc"];

    $lug_cuali                   = $_POST["lug_cuali_2_pn"];
    $lug_cualifica               = $_POST["lug_cualifica_2_pn"];
    $nombre_cuali                = "";
    foreach ($inf_cu as $registro) {
        if ($registro->cod_cuali == $lug_cualifica) {
            $nombre_cuali = $registro->cualificacion;
            break;
        }
    }
    $fech_cualifi                = $_POST["fech_cualifi_2_pn"];
    
    if (isset($_FILES['doc_cualifi_2_pn']) && $_FILES['doc_cualifi_2_pn']['error'] === UPLOAD_ERR_OK) {

        $targetCua = "../../documents/cualificaciones/$user/";

        // Crea el directorio si no existe
        if (!file_exists($targetCua)){
            mkdir($targetCua,0755,true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['doc_cualifi_2_pn']["name"];
        $extension = pathinfo($_FILES['doc_cualifi_2_pn']["name"],PATHINFO_EXTENSION);
        $file_name = $user.'-'.'doc2'.'.'.$extension;
        $add = $targetCua . $file_name;
        $rutaDocCua = "../documents/cualificaciones/$user/$file_name";

        // Mover el archivo temporal a la ubicación deseada
        if(move_uploaded_file($_FILES['doc_cualifi_2_pn']["tmp_name"],$add)){}

        try {
            $query =("INSERT INTO cualificaciones (numero_doc,lugar,cod_cuali,nom_cualifi,fec_cualifi,doc_cualifi)
                VALUES (:num_doc,:lug_cuali,:lug_cualifica,:nombre_cuali,:fec_cuali,:doc_culi)");
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
            $insert -> bindParam(':lug_cuali',$lug_cuali,PDO::PARAM_STR);
            $insert -> bindParam(':lug_cualifica',$lug_cualifica,PDO::PARAM_STR);
            $insert -> bindParam(':nombre_cuali',$nombre_cuali,PDO::PARAM_STR);
            $insert -> bindParam(':fec_cuali',$fech_cualifi,PDO::PARAM_STR);
            $insert -> bindParam(':doc_culi',$rutaDocCua,PDO::PARAM_STR);
            $insert -> execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);

    } else {
        try {
            $query =("INSERT INTO cualificaciones (numero_doc,lugar,cod_cuali,nom_cualifi,fec_cualifi)
                VALUES (:num_doc,:lug_cuali,:lug_cualifica,:nombre_cuali,:fec_cuali)");
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
            $insert -> bindParam(':lug_cuali',$lug_cuali,PDO::PARAM_STR);
            $insert -> bindParam(':lug_cualifica',$lug_cualifica,PDO::PARAM_STR);
            $insert -> bindParam(':nombre_cuali',$nombre_cuali,PDO::PARAM_STR);
            $insert -> bindParam(':fec_cuali',$fech_cualifi,PDO::PARAM_STR);
            $insert -> execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);
    }
}
?>