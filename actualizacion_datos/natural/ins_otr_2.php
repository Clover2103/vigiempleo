<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $user = $_SESSION["num_doc"];

    $nom_inst                   = $_POST["nom_inst_otro_2_pn"];
    $tit_op                     = $_POST["tit_op_otro_2_pn"];
    $tie_fin                    = $_POST["tie_fin_otro_2_pn"];
    
    $targetOtr = "../../documents/otro/$user/";

    if (!file_exists($targetOtr)){
        mkdir($targetOtr,0755,true);
        echo("Entre aqui pues papa primera cualificacion");
    }

    if(isset($_FILES['comp_otro_2_pn']["name"])){
        $file_name = $_FILES['comp_otro_2_pn']["name"];
        
        $extension = pathinfo($_FILES['comp_otro_2_pn']["name"],PATHINFO_EXTENSION);
        
        $file_name = $user.'-'.'doc2'.'.'.$extension;
        $add = $targetOtr . $file_name;

        $rutaDocOtr = "../documents/otro/$user/$file_name";
        
        if(move_uploaded_file($_FILES['comp_otro_2_pn']["tmp_name"],$add)){}
    
    }

    try {
        $query =("INSERT INTO otro_estudios (numero_doc,nivel_ins_otro,titulo_otro,fec_fin_otro,comp_otro)
            VALUES (:num_doc,:nom_inst,:tit_op,:tie_fin,:doc_otro)");
        $insert = $conexion->prepare("$query");
        $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
        $insert -> bindParam(':nom_inst',$nom_inst,PDO::PARAM_STR);
        $insert -> bindParam(':tit_op',$tit_op,PDO::PARAM_STR);
        $insert -> bindParam(':tie_fin',$tie_fin,PDO::PARAM_STR);
        $insert -> bindParam(':doc_otro',$rutaDocOtr,PDO::PARAM_STR);
        $insert -> execute();
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}
?>