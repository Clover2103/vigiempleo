<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();
    session_start();

    $query = "SELECT * FROM nivel_academico";
    $smtm = $conexion->prepare($query);
    $smtm->execute();
    $inf_na = $smtm->fetchAll(PDO::FETCH_OBJ);

    $user = $_SESSION["num_doc"];

    $nom_insti                  = $_POST['nombre_instituto_2_pn'];
    $nivel_aca                  = $_POST['nivel_academico_2_pn'];
    $nivel                      = "";
    foreach ($inf_na as $registro) {
        if ($registro->cod_na == $nivel_aca) {
            $nivel = $registro->nivel_academico;
            break;
        }
    }
    $titulo                     = $_POST['titulo_op_2_pn'];
    $culmino                    = $_POST["y_stu_2_pn"];
    $sig_estu                   = $culmino === "si" ? 1 : 0;
    $finalizacion               = $_POST['tiempo_fin_2_pn'];

    if (isset($_FILES['comp_stu_2_pn']) && $_FILES['comp_stu_2_pn']['error'] === UPLOAD_ERR_OK) {

        $targetEstu = "../../documents/est_for/$user/";

        // Crea el directorio si no existe
        if (!file_exists($targetEstu)){
            mkdir($targetEstu,0755,true);
        }

        // Obtiene el nombre y la extensión del archivo
        $file_name = $_FILES['comp_stu_2_pn']["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = $user . '-est_for2.' . $extension;
        $add = $targetEstu . $file_name;
        $targetStudy = "../documents/est_for/$user/$file_name";

        // Mover el archivo temporal a la ubicación deseada
        if(move_uploaded_file($_FILES['comp_stu_2_pn']["tmp_name"],$add)){}

        try {
            $query =("INSERT INTO estudios (numero_doc,nom_insti,cod_na,nivel_aca,titulo,culmino,sig_estu,fec_fin,comp_est)
                VALUES (:num_doc,:nom_ins,:niv_aca,:nivel,:titulo,:culmino,:sig_estu,:fec_fin,:comp_estu)");
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
            $insert -> bindParam(':nom_ins',$nom_insti,PDO::PARAM_STR);
            $insert -> bindParam(':niv_aca',$nivel_aca,PDO::PARAM_STR);
            $insert -> bindParam(':nivel',$nivel,PDO::PARAM_STR);
            $insert -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
            $insert -> bindParam(':culmino',$culmino,PDO::PARAM_STR);
            $insert -> bindParam(':sig_estu',$sig_estu,PDO::PARAM_STR);
            $insert -> bindParam(':fec_fin',$finalizacion,PDO::PARAM_STR);
            $insert -> bindParam(':comp_estu',$targetStudy,PDO::PARAM_STR);
            $insert -> execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);

    } else {
        try {
            $query =("INSERT INTO estudios (numero_doc,nom_insti,cod_na,nivel_aca,titulo,culmino,sig_estu,fec_fin)
                VALUES (:num_doc,:nom_ins,:niv_aca,:nivel,:titulo,:culmino,:sig_estu,:fec_fin)");
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':num_doc',$user,PDO::PARAM_STR);
            $insert -> bindParam(':nom_ins',$nom_insti,PDO::PARAM_STR);
            $insert -> bindParam(':niv_aca',$nivel_aca,PDO::PARAM_STR);
            $insert -> bindParam(':nivel',$nivel,PDO::PARAM_STR);
            $insert -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
            $insert -> bindParam(':culmino',$culmino,PDO::PARAM_STR);
            $insert -> bindParam(':sig_estu',$sig_estu,PDO::PARAM_STR);
            $insert -> bindParam(':fec_fin',$finalizacion,PDO::PARAM_STR);
            $insert -> execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);
    }
}
?>