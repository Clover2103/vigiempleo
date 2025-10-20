<?php

    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $cont = [];
    $vacante =      $_POST["vacante"];

    try {
        $query = "SELECT cod_dep, departamento FROM departamentos";
        $departamentos = $conexion->query($query)->fetchAll(PDO::FETCH_ASSOC);

        $query = "SELECT mc.*, v.id_vacante FROM municipio mc
        INNER JOIN vacante v ON mc.cod_dep = v.departamento
        WHERE v.id_vacante = '$vacante'
        ORDER BY mc.cod_mun";
        $municipios = $conexion->query($query)->fetchAll(PDO::FETCH_ASSOC);

        $query = "SELECT 
                v.*, mc.*, dp.*
            FROM
                vacante v
            INNER JOIN
                municipio mc ON v.municipio = mc.cod_mun
            INNER JOIN
                departamentos dp ON v.departamento = dp.cod_dep
            WHERE 
                id_vacante = '$vacante'";
        $insert = $conexion->prepare($query);
        $insert->execute();
        $inf_vac = $insert->fetch(PDO::FETCH_ASSOC);

        if ($insert->rowCount() >= 1 ) {
            $json[] = array(
                'id_vacante'        => $inf_vac['id_vacante'],
                'nom_vacante'       => $inf_vac['nom_vacante'],
                'descripcion'       => $inf_vac['descripcion'],
                'salario'           => $inf_vac['salario'],
                'estado'            => $inf_vac['estado'],
                'departamento'      => $inf_vac['departamento'],
                'cod_dep'           => $inf_vac['cod_dep'],
                'municipio'         => $inf_vac['municipio'],
                'cod_mun'           => $inf_vac['cod_mun']
            );
        }

        $cont['mensaje']        = $json;
        $cont['departamentos']  = $departamentos;
        $cont['municipios']     = $municipios;
    } catch (PDOException $e) {
        $cont['error'] = "Surgió un error" . $e->getMessage();
    }
    echo json_encode($cont);

?>