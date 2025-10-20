<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $cont = [];
        include_once("../../conexion-PDO.php");
        $objeto = new Cconexion();
        $conexion = $objeto -> conexionBD();
        session_start();

        $id_vac  =          $_POST['oculto_inp'];
        $nom_vac =          $_POST['nom_vacante_edi'];
        $des_vac =          $_POST['des_vacante_edi'];
        $sal_vac =          $_POST['sal_vacante_edi'];
        $dep_vac =          $_POST['departamento_vacante_edi'];
        $mun_vac =          $_POST['municipio_vacante_edi'];
        $estado  =          $_POST['estado'];

        if ($estado === "false") {
            $estado = 1;
        } else {
            $estado = 0;
        }

        try {
            $query ="UPDATE 
                        vacante
                    SET
                        nom_vacante = :nom_vac,
                        descripcion = :des_vac,
                        salario = :sal_vac,
                        departamento = :dep_vac,
                        municipio = :mun_vac,
                        estado = :estado
                    WHERE
                        id_vacante = :id_vac";
            $insert = $conexion->prepare("$query");
            $insert -> bindParam(':id_vac',$id_vac,PDO::PARAM_STR);
            $insert -> bindParam(':nom_vac',$nom_vac,PDO::PARAM_STR);
            $insert -> bindParam(':des_vac',$des_vac,PDO::PARAM_STR);
            $insert -> bindParam(':sal_vac',$sal_vac,PDO::PARAM_STR);
            $insert -> bindParam(':dep_vac',$dep_vac,PDO::PARAM_STR);
            $insert -> bindParam(':mun_vac',$mun_vac,PDO::PARAM_STR);
            $insert -> bindParam(':estado',$estado,PDO::PARAM_STR);
            $insert->execute();
            $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes'; 
        } catch (PDOException $e) {
            $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
        }
        echo json_encode($cont);

    }

?>