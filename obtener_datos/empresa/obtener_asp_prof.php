<?php
    
    session_start();
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto -> conexionBD();

    $vacante =      $_POST["vacante"];
    $id_user =      $_POST["id_user"];
    $usuario =      $_SESSION["id_empr"];

    $query = "SELECT	
            un.tipo_doc,
            un.numero_doc,
            un.primer_nombre,
            un.segundo_nombre,
            un.primer_apellido,
            un.segundo_apellido,
            un.edad,
            un.foto,
            cu.correo,
            cu.telefono,
            v.id_vacante
        FROM usuario_natural un 
        INNER JOIN cont_usuario cu ON un.numero_doc = cu.numero_doc 
        INNER JOIN natural_vacante nv ON un.numero_doc = nv.numero_doc
        INNER JOIN vacante v ON nv.id_vacante = v.id_vacante
        WHERE
            nv.id_empresa = '$usuario' AND nv.id_vacante = '$vacante' AND un.numero_doc = '$id_user'";

    $insert = $conexion->prepare($query);
    $insert->execute();
    $json = array();
    
    if ($insert->rowCount() > 0 ) {
        // print_r($inf_query);
        while ($inf_query = $insert->fetch(PDO::FETCH_ASSOC)) {
            $json[] = array(
                'tip_doc'       => $inf_query['tipo_doc'],
                'num_doc'       => $inf_query['numero_doc'],
                'pri_nom'       => $inf_query['primer_nombre'],
                'seg_nom'       => $inf_query['segundo_nombre'],
                'pri_ape'       => $inf_query['primer_apellido'],
                'seg_ape'       => $inf_query['segundo_apellido'],
                'edad'          => $inf_query['edad'],
                'foto'          => $inf_query['foto'],
                'correo'        => $inf_query['correo'],
                'telefono'      => $inf_query['telefono'],
                'id_vac'        => $inf_query['id_vacante']
            );
        }
    } 
    
    $arraydatos['datos'] = $json;
    echo json_encode($arraydatos);
?>