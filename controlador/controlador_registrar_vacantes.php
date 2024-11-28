<?php 
    if (!isset($_POST["nom_vacante"]) && !isset($_POST["des_vacante"]) && !isset($_POST["sal_vacante"])) {
        echo 'Uno de los campos requeridos esta incompleto o vacio';
        } else {
        $cont = [];
        include_once("../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto -> conexionBD();
        session_start();

        // Informacion de tabla usuario natural
        $id_empresa =               $_SESSION["id_empr"];   
        $nom_vacante =              $_POST["nom_vacante"];
        $des_vacante=               $_POST["des_vacante"];
        $sal_vacante =              $_POST["sal_vacante"];
        $departamento_vac=          $_POST["departamento_vac"];
        $municipios_vac=            $_POST["municipios_vac"];

        try {
            $query ="INSERT INTO vacante (id_empresa,nom_vacante,descripcion,salario,municipio,departamento)
                VALUES (:id_emp,:nom_vac,:desc_vac,:sal_vac,:mun_vac,:dep_vac)";
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':id_emp',$id_empresa,PDO::PARAM_STR);
            $insert -> bindParam(':nom_vac',$nom_vacante,PDO::PARAM_STR);
            $insert -> bindParam(':desc_vac',$des_vacante,PDO::PARAM_STR);
            $insert -> bindParam(':sal_vac',$sal_vacante,PDO::PARAM_STR);
            $insert -> bindParam(':dep_vac',$departamento_vac,PDO::PARAM_STR);
            $insert -> bindParam(':mun_vac',$municipios_vac,PDO::PARAM_STR);
            $insert->execute();
            $cont['mensaje'] = "Se realizaron las modificaciones correspondientes";
        } catch (PDOException $e) {
            $cont['error'] = "Surgió un error" . $e->getMessage();
        }
        echo json_encode($cont);
    }
?>