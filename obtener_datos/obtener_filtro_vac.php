<?php

    session_start();
    include_once("../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $perPage = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;

    $cargo          = $_GET['cargo'];
    $municipio      = $_GET['municipio'];
    $departamento   = $_GET['departamento'];
    $empresa        = $_GET['empresa'];

    $query = "SELECT v.*, ue.logo_empresa, ue.razon_social, mc.municipio
                FROM vacante v
                INNER JOIN municipio mc ON v.municipio = mc.cod_mun
                INNER JOIN usuario_empresa ue ON v.id_empresa = ue.id_empresa
                WHERE (v.nom_vacante = '$cargo' OR '$cargo' = '') AND v.estado = 1";

    if ($municipio !== '') {
        $query .= " AND (v.municipio = '$municipio' OR '$municipio' = '')";
    }

    if ($departamento !== '') {
        $query .= " AND (v.departamento = '$departamento' OR '$departamento' = '')";
    }

    if ($empresa !== '') {
        $query .= " AND v.id_empresa = '$empresa'";
    }

    $query .= " ORDER BY v.id_vacante DESC
                LIMIT $perPage OFFSET $offset";

    $insert = $conexion->prepare($query);
    $insert->execute();
    $json = array();
    
    if ($insert->rowCount() > 0 ) {
        while ($inf_query = $insert->fetch(PDO::FETCH_ASSOC)) {
            $json[] = array(
                'id_vac'        => $inf_query['id_vacante'],
                'id_emp'        => $inf_query['id_empresa'],
                'nom_vac'       => $inf_query['nom_vacante'],
                'descrip'       => $inf_query['descripcion'],
                'salario'       => $inf_query['salario'],
                'municipio'     => $inf_query['municipio'],
                'log_emp'       => $inf_query['logo_empresa'],
                'nom_emp'       => $inf_query['razon_social']
            );
        }
    }
    
    $arraydatos['datos'] = $json;
    echo json_encode($arraydatos);

?>