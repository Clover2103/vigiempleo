<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cont = [];
    include_once("../../conexion-PDO.php");
    $objeto = new Cconexion();
    $conexion = $objeto->conexionBD();
    session_start();

    $user = $_SESSION["num_doc"];

    $pri_nom = $_POST["pri_nom"];
    $seg_nom = $_POST["seg_nom"];
    $pri_ape = $_POST["pri_ape"];
    $seg_ape = $_POST["seg_ape"];
    $tip_doc = $_POST["tip_doc"];
    $descrip = $_POST["descrip"];
    $direccion = $_POST["direcci"];
    $departamento_pn = $_POST["departamento_pn"];
    $municipio_pn = $_POST["municipio_pn"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];

    try {
        $query = "UPDATE usuario_natural 
                SET primer_nombre = :pri_nom,
                    segundo_nombre = :seg_nom,
                    primer_apellido = :pri_ape,
                    segundo_apellido = :seg_ape,
                    tipo_doc = :tip_doc,
                    descripcion = :descrip
                WHERE numero_doc = :user";
        $insert = $conexion->prepare($query);
        $insert->bindParam(':pri_nom', $pri_nom);
        $insert->bindParam(':seg_nom', $seg_nom);
        $insert->bindParam(':pri_ape', $pri_ape);
        $insert->bindParam(':seg_ape', $seg_ape);
        $insert->bindParam(':tip_doc', $tip_doc);
        $insert->bindParam(':descrip', $descrip);
        $insert->bindParam(':user', $user);
        $insert->execute();

        $query2 = "UPDATE cont_usuario 
                SET correo = :correo,
                    telefono = :celular,
                    departamento = :departamento,
                    municipio = :municipio,
                    direccion = :direccion
                WHERE numero_doc = :user";
        $insert2 = $conexion->prepare($query2);
        $insert2->bindParam(':correo', $correo);
        $insert2->bindParam(':celular', $celular);
        $insert2->bindParam(':departamento', $departamento_pn);
        $insert2->bindParam(':municipio', $municipio_pn);
        $insert2->bindParam(':direccion', $direccion);
        $insert2->bindParam(':user', $user);
        $insert2->execute();

        if ($insert->rowCount() > 0 || $insert2->rowCount() > 0) {
            $cont['okay'] = "V";
            $_SESSION["pri_nom"] = $pri_nom;
            $_SESSION["seg_nom"] = $seg_nom;
            $_SESSION["pri_ape"] = $pri_ape;
            $_SESSION["seg_ape"] = $seg_ape;
            $_SESSION["tip_doc"] = $tip_doc;
            $_SESSION["des_nat"] = $descrip;
            $_SESSION["correo"]  = $correo;
            $_SESSION["departamento"]  = $departamento_pn;
            $_SESSION["municipio"]  = $municipio_pn;
            $_SESSION["tel_nat"] = $celular;
            $_SESSION["dir_nat"] = $direccion;
        } else {
            $cont['error'] =  'Surgio un error de modificacion';
        }
        $cont['mensaje'] = 'Se realizaron las modificaciones correspondientes';   
    } catch (PDOException $e) {
        $cont['error'] =  'Surgio un error de modificacion' . $e->getMessage();
    }
    echo json_encode($cont);
}
?>
