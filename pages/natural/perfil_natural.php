<?php

session_start();
if (!isset($_SESSION["num_doc"])) {
    header("location: ../login.php");
}else{
    if ($_SESSION["rec_cred"] !== true) {
        if((time() - $_SESSION['time']) > $_SESSION['minutos']){
            header("location: ./session_close.php");
        }else{
            $_SESSION['time'] = time();
        }   
    }
}

include_once ("../../conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto -> conexionBD();

$usuario = $_SESSION["num_doc"];
$estado  = $_SESSION["estado"];

$query = "SELECT * FROM departamentos";
$insert = $conexion->prepare($query);
$insert->execute();
$insert_dp = $insert->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM municipio";
$insert = $conexion->prepare($query);
$insert->execute();
$insert_mc = $insert->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM nivel_academico";
$smtm = $conexion->prepare($query);
$smtm->execute();
$inf_na = $smtm->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM ciclo_capacitacion";
$smtm = $conexion->prepare($query);
$smtm->execute();
$inf_cc = $smtm->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM ciclo_cualificacion";
$smtm = $conexion->prepare($query);
$smtm->execute();
$inf_cu = $smtm->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM natural_vacante WHERE numero_doc = '$usuario'";
$insert = $conexion->prepare($query);
$insert->execute();
$insert_ob = $insert->fetchAll(PDO::FETCH_OBJ);
$cantidad = $insert->rowCount();

$query_lab = "SELECT * FROM ref_laboral WHERE numero_doc = '$usuario'";
$insert_lab = $conexion->prepare($query_lab);
$insert_lab->execute();
$cantidad_lab = $insert_lab->rowCount();

if ($cantidad_lab > 0) {
    $insert_lab_ob = $insert_lab->fetchAll(PDO::FETCH_OBJ);
}

$query_est = "SELECT * FROM estudios WHERE numero_doc = '$usuario'";
$insert_est = $conexion->prepare($query_est);
$insert_est->execute();
$cantidad_est = $insert_est->rowCount();

if ($cantidad_est > 0) {
    $insert_est_ob = $insert_est->fetchAll(PDO::FETCH_OBJ);
}

$query_cua = "SELECT * FROM cualificaciones WHERE numero_doc = '$usuario'";
$insert_cua = $conexion->prepare($query_cua);
$insert_cua->execute();
$cantidad_cua = $insert_cua->rowCount();

if ($cantidad_cua > 0) {
    $insert_cua_ob = $insert_cua->fetchAll(PDO::FETCH_OBJ);
}

$query_otr = "SELECT * FROM otro_estudios WHERE numero_doc = '$usuario'";
$insert_otr = $conexion->prepare($query_otr);
$insert_otr ->execute();
$cantidad_otr = $insert_otr->rowCount();

if ($cantidad_otr > 0) {
    $insert_otr_ob = $insert_otr->fetchAll(PDO::FETCH_OBJ);
    
}

$query_cap = "SELECT * FROM capacitaciones WHERE numero_doc = '$usuario'";
$insert_cap = $conexion->prepare($query_cap);
$insert_cap->execute();
$cantidad_cap = $insert_cap->rowCount();

if ($cantidad_cap > 0) {
    $insert_cap_ob = $insert_cap->fetchAll(PDO::FETCH_OBJ);
}

$query_per = "SELECT * FROM ref_personal WHERE numero_doc = '$usuario'";
$insert_per = $conexion->prepare($query_per);
$insert_per->execute();
$cantidad_per = $insert_per->rowCount();

if ($cantidad_per > 0) {
    $insert_per_ob = $insert_per->fetchAll(PDO::FETCH_OBJ);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../../css/normalize.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/redes.css">
    <link rel="stylesheet" href="../../css/perfil_natural.css">
    <link rel="shortcut icon" href="../../img/Ojo vigiempleo cuadrado.ico">
    <title>Vigiempleo</title>
</head>
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FBWSFZRETJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FBWSFZRETJ');
</script>
<body>
    <!-- Menu -->
    <header class="menu">
        <nav class="menu_nav">
            <div class="menu_logo">
                <img src="../../img/menu/logo vigiempleo.png" alt="logo">
            </div>
            <div class="menu_link">
                <ul class="menu_ul">
                    <li><a href="./inicio.php">Inicio</a></li>
                    <li><a href="./nosotros.php">Nosotros</a></li>
                    <li><a href="./noticias.php">Noticias</a></li>
                    <li><a href="./contactenos.php">Contactenos</a></li>
                </ul>
            </div>
            <div>
                <div class="menu_btn">
                    <div class="cont_ftn_btn">
                        <img src="../<?php echo $_SESSION["fot_nat"]; ?>" alt="Foto de usuario">
                    </div>
                    <button id="dropdown-button" class="per_nat">
                        <input type="checkbox" name="" id="nav__checkbox_1" class="nav__checkbox_2">
                        <label for="nav__checkbox_2" class="nav__toggle_2">
                            <!-- Open -->
                            <svg class="open_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.89 34.65">
                                <title>flecha abajoRecurso 3</title>
                                <g id="Capa_2" data-name="Capa 2">
                                    <g id="Capa_1-2" data-name="Capa 1">
                                        <path d="M30.23,22.65c6.33-5.7,14-12.58,21.62-19.48,1.92-1.74,3.77-4.71,6.6-2.21s.92,5-1.19,7.23c-7.74,8-15.53,16-23.11,24.13-3,3.26-5.34,3-8.22-.1C18.19,24,10.29,15.89,2.48,7.72.73,5.89-1.32,3.86,1.12,1.34,3.79-1.41,5.8.83,7.84,2.67,15.63,9.69,23.48,16.63,30.23,22.65Z"/>
                                    </g>
                                </g>
                            </svg>
                            <!-- Close -->
                            <svg class="close_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.89 34.65">
                                <title>flecha arribaRecurso 4</title>
                                <g id="Capa_2" data-name="Capa 2">
                                    <g id="Capa_1-2_us_nat" data-name="Capa 1">
                                        <path d="M29.65,12C23.32,17.7,15.66,24.57,8,31.48c-1.92,1.74-3.77,4.71-6.6,2.2s-.91-5,1.2-7.22c7.73-8,15.52-16,23.1-24.13,3-3.26,5.35-3,8.23.09,7.73,8.25,15.63,16.33,23.45,24.5,1.75,1.83,3.8,3.86,1.35,6.38-2.67,2.75-4.67.52-6.72-1.32C44.26,25,36.41,18,29.65,12Z"/>
                                    </g>
                                </g>
                            </svg>
                        </label>
                    </button>
                </div>    
                <ul id="dropdown-menu">
                    <li><a href="./perfil_natural.php">VER PERFIL</a></li>
                    <li><a href="./vacantes.php?cargo=''&ciudad=''">BUSCAR OFERTA</a></li>
                    <li><a id="btnCerrarSUN"><b>CERRAR SESION</b></a></li>
                </ul>
            </div>
        </nav>

        <!-- Menu responsive -->
        <nav class="menu_nav_responsive">

            <input type="checkbox" name="" id="nav__checkbox" class="nav__checkbox">
            <label for="nav__checkbox" class="nav__toggle">
                <!-- Open -->
                <svg class="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.89 34.65">
                    <title>flecha abajoRecurso 3</title>
                    <g id="Capa_2" data-name="Capa 2">
                        <g id="Capa_1-2" data-name="Capa 1">
                            <path d="M30.23,22.65c6.33-5.7,14-12.58,21.62-19.48,1.92-1.74,3.77-4.71,6.6-2.21s.92,5-1.19,7.23c-7.74,8-15.53,16-23.11,24.13-3,3.26-5.34,3-8.22-.1C18.19,24,10.29,15.89,2.48,7.72.73,5.89-1.32,3.86,1.12,1.34,3.79-1.41,5.8.83,7.84,2.67,15.63,9.69,23.48,16.63,30.23,22.65Z"/>
                        </g>
                    </g>
                </svg>
                <!-- Close -->
                <svg class="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.89 34.65">
                    <title>flecha arribaRecurso 4</title>
                    <g id="Capa_2" data-name="Capa 2">
                        <g id="Capa_1-2" data-name="Capa 1">
                            <path d="M29.65,12C23.32,17.7,15.66,24.57,8,31.48c-1.92,1.74-3.77,4.71-6.6,2.2s-.91-5,1.2-7.22c7.73-8,15.52-16,23.1-24.13,3-3.26,5.35-3,8.23.09,7.73,8.25,15.63,16.33,23.45,24.5,1.75,1.83,3.8,3.86,1.35,6.38-2.67,2.75-4.67.52-6.72-1.32C44.26,25,36.41,18,29.65,12Z"/>
                        </g>
                    </g>
                </svg>
            </label>

            <ul class="nav__menu">
                <li class="menu__logo_responsive">
                    <img src="../../img/menu/logo vigiempleo.png" alt="logo">
                </li>
                <li><a href="./inicio.php">Inicio</a></li>
                <li><a href="./nosotros.php">Nosotros</a></li>
                <li><a href="./noticias.php">Noticias</a></li>
                <li><a href="./contactenos.php">Contactenos</a></li>
                <li>
                    <div class="button_responsive">
                        <div>
                            <div class="menu_btn">
                                <div class="cont_ftn_btn">
                                    <img src="<?php echo '../'.$_SESSION["fot_nat"]; ?>" alt="Foto de usuario">
                                </div>
                                <button id="dropdown-button_2" class="per_nat">
                                    <input type="checkbox" name="" id="nav__checkbox_2" class="nav__checkbox_2">
                                    <label for="nav__checkbox_2" class="nav__toggle_2">
                                        <!-- Open -->
                                        <svg class="open_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.89 34.65">
                                            <title>flecha abajoRecurso 3</title>
                                            <g id="Capa_2" data-name="Capa 2">
                                                <g id="Capa_1-2" data-name="Capa 1">
                                                    <path d="M30.23,22.65c6.33-5.7,14-12.58,21.62-19.48,1.92-1.74,3.77-4.71,6.6-2.21s.92,5-1.19,7.23c-7.74,8-15.53,16-23.11,24.13-3,3.26-5.34,3-8.22-.1C18.19,24,10.29,15.89,2.48,7.72.73,5.89-1.32,3.86,1.12,1.34,3.79-1.41,5.8.83,7.84,2.67,15.63,9.69,23.48,16.63,30.23,22.65Z"/>
                                                </g>
                                            </g>
                                        </svg>
                                        <!-- Close -->
                                        <svg class="close_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.89 34.65">
                                            <title>flecha arribaRecurso 4</title>
                                            <g id="Capa_2" data-name="Capa 2">
                                                <g id="Capa_1-2_us_nat" data-name="Capa 1">
                                                    <path d="M29.65,12C23.32,17.7,15.66,24.57,8,31.48c-1.92,1.74-3.77,4.71-6.6,2.2s-.91-5,1.2-7.22c7.73-8,15.52-16,23.1-24.13,3-3.26,5.35-3,8.23.09,7.73,8.25,15.63,16.33,23.45,24.5,1.75,1.83,3.8,3.86,1.35,6.38-2.67,2.75-4.67.52-6.72-1.32C44.26,25,36.41,18,29.65,12Z"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </label>
                                </button>
                            </div>    
                            <ul id="dropdown-menu_2">
                                <li><a href="./perfil_natural.php">VER PERFIL</a></li>
                                <li><a href="./vacantes.php?cargo=''&ciudad=''">BUSCAR OFERTA</a></li>
                                <li><a id="btnCerrarSUN2"><b>CERRAR SESION</b></a></li>
                            </ul>
                        </div>
                    </div>
                </li>   
            </ul>
        </nav>
    </header>

    <!-- ////////////////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////// MEIN CUERPO NATURAL /////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////////////////// -->

    <main class="cuerpo cuerpo_1" id="cuerpo_1">

        <!-- SECCION DE FOTO E INFORMACIÓN GENERAL -->
        <section class="cuerpo_sliter">
            <div class="container_div">

                <div class="inf_usuario">

                    <!-- Foto, contenedor del input y la camara -->
                    <div class="div_inf_foto">

                        <!-- Foto desde el servidor -->
                        <div class="registro_foto">
                            <div class="img_preview">
                                <img src="../<?php echo $_SESSION["fot_nat"]; ?>" alt="Foto de usuario">
                            </div>
                        </div>

                    </div>

                    <!-- Informacion general de contacto -->
                    <diV class="container txt-c">

                        <!-- Nombre completo -->
                        <h2 class="mt-4 mb-5">
                            <?php
                                echo $_SESSION["pri_nom"] . " " .  $_SESSION["seg_nom"] . " " . $_SESSION["pri_ape"] . " " . $_SESSION["seg_ape"];
                            ?>
                        </h2>

                        <div class="row g-3">

                            <div class="col-md">
                                <p><?php echo "<b>". $_SESSION["tip_doc"] . "</b>" . ": " .  $_SESSION["num_doc"];?></p>
                            </div>

                            <div class="col-md">
                                <p><?php echo "<b>CORREO: <br></b>" .  $_SESSION["correo"]; ?></p>
                            </div>

                            <div class="col-md">
                                <p><?php echo "<b>CELULAR: <br></b>" .  $_SESSION["tel_nat"] ; ?></p>
                            </div>

                        </div>

                        <div class="row g-3">

                            <div class="col-md">
                                <p>
                                    <?php
                                    foreach ($insert_dp as $departamento) {
                                        echo ($_SESSION["departamento"] == $departamento->cod_dep) ? "<b>DEPARTAMENTO: <br></b>" . $departamento->departamento : "";
                                    }                                    
                                    ?>
                                </p>
                            </div>

                            <div class="col-md">
                                <p>
                                    <?php
                                    foreach ($insert_mc as $municipio) {
                                        echo ($_SESSION["municipio"] == $municipio->cod_mun) ? "<b>MUNICIPIO: <br></b>" . $municipio->municipio : "";
                                    }                                    
                                    ?>
                                </p>
                            </div>

                            <div class="col-md">
                                <p><?php echo "<b>DIRECCIÓN:  <br></b>" . $_SESSION["dir_nat"] ;?></p>
                            </div>

                        </div>

                    </diV>
                </div>
                <div class="cuerpo_sliter_btn">
					<div class="cont_dese">
                        <div class="check_btn">
                            <label id="estado_des" class="estado_des">Desempleado(a) </label>
                            <div class="wrap-toggle">
                                <input type="checkbox" id="estado" class="offscreen estado">
                                <label for="estado" class="swith"></label>
                            </div>
                        </div>
                    </div>
                    <button id="btn_edi_per_nat">
                        Editar perfil
                    </button>
                </div>
            </div>
        </section>

        <section class="container mt-4">
            <div class="row g-2">
                <div class="col-md">

                    <div class="container cont-ifm m-1 p-2">

                        <h3>
                            SOBRE MI
                        </h3>

                        <div class="" id="cont_des">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                                echo "<br>" . $_SESSION["des_nat"] . "<br><br>";
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>

                    <div class="container cont-ifm m-1 p-2">

                        <h3 class="pt-3">
                            EXPERIENCIA LABORAL
                        </h3>

                        <div class="expe_lab" id="expe_lab">
                            
                        </div>

                    </div>
                </div>
				
                <div class="col-md dfx">
                    <div class="cont_cuer_der">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.96 95.62">
                            <title>icono vacantesRecurso 6</title>
                            <g id="Capa_2_vaca" data-name="Capa 2">
                                <g id="Capa_1-2_vaca" data-name="Capa 1">
                                    <path d="M8.64,12.64c0,3.09,0,6.18,0,9.27,0,.8.13,1.72-1.14,1.72s-1.16-.91-1.17-1.71q0-9.42,0-18.82c0-.83-.05-1.72,1.17-1.73s1.14.91,1.15,1.72Z"/><path d="M90.74,22.56c0-3.08,0-6.16,0-9.25,0-.78-.18-1.75,1.11-1.73s1,1,1,1.77c0,6.26,0,12.51,0,18.77,0,.76.22,1.76-1.08,1.74s-1.06-1-1.07-1.78C90.73,28.91,90.74,25.73,90.74,22.56Z"/><path d="M8.66,31.32c0,1.1.18,2.19-1.27,2.06-1.61-.15-1-1.45-1.07-2.32s-.12-2,1.28-1.85C9.28,29.34,8.32,30.75,8.66,31.32Z"/><path d="M93,41.62c-.17.8.34,2-1.12,2s-1.13-1.17-1.12-2-.3-2.24,1.27-2.13C93.38,39.59,92.75,40.85,93,41.62Z"/><path d="M72,19.69c-1.16-2.78-.38-5.69-.46-8.53,0-1.82-.42-2.51-2.4-2.5q-21.53.12-43,0c-2,0-2.38.74-2.37,2.53.07,11,0,22,0,33,0,1.25.05,2.35,1.46,2.82-1.51.22-1.88-.61-1.88-1.92,0-11.54.05-23.08,0-34.61,0-2.22,1.25-2.21,2.82-2.2q17.58,0,35.15,0c2.73,0,5.45.08,8.17,0,1.86-.07,2.64.54,2.56,2.48C71.94,13.69,72,16.7,72,19.69Z"/><path d="M85.33,20.25c0-1,0-2.09-1-2.7-3.21-2.08-3.55-5.17-3.29-8.59.16-2-.08-4,.06-6C81.3.68,80.41,0,78.15,0Q48.39.13,18.64,0c-2.55,0-3,.89-3,3.16.1,11.74,0,23.48.07,35.22a5.65,5.65,0,0,1-1.36,4C10.2,47.38,6.15,52.53,2,57.58A8.15,8.15,0,0,0,0,63.08c0,9.92.1,19.84,0,29.76,0,2.39.8,2.8,3,2.78,13.1-.1,26.21-.05,39.31-.05,13.38,0,26.76,0,40.13,0,2,0,3-.46,3-2.72Q85.27,56.57,85.33,20.25Zm-4.64-2.66c-1.9.63-3.86.24-5.8.25-.79,0-1-.6-1-1.3V10.37ZM20.6,2.2q27.71.13,55.4,0c2.15,0,2.92.57,2.73,2.74s0,4.09,0,6.49C76.32,9.9,75.11,7.75,73,6.65a2.74,2.74,0,0,0-1.84-.28H23.85a3.49,3.49,0,0,0-1.6.2l0,0c-1.05.81-.76,2-.76,3,0,11.54,0,23.08,0,34.63,0,.93.47,2-.41,2.82-1.24.16-1.83,1.34-2.76,2-.6-.69-.36-1.35-.36-2,0-14,0-28-.06-42C17.88,2.89,18.38,2.19,20.6,2.2Zm1.65,89.3a2.93,2.93,0,0,1-3,1.8c-4.91-.09-9.83-.1-14.74,0-1.83,0-2.32-.63-2.31-2.38.07-9.19,0-18.38,0-27.57a4.93,4.93,0,0,1,.67-3.16C7,55.09,11.05,50,15.64,44.33c0,5.9.11,11-.05,16a5.06,5.06,0,0,1-3.23,4.92,6.85,6.85,0,0,0-1.93,1.49c-.45.41-1.06.92-.33,1.57.47.42,1,.74,1.69.22C14.54,66.45,17.74,65,18,60.65c.17-3.12,1.37-6.18,2.13-9.26.53-2.13,1.89-3.07,4.05-2.58s2.85,2,2.41,4.12q-2.09,10.27-4.12,20.55A8.91,8.91,0,0,0,22.73,78C24.13,82.53,24.71,87.06,22.25,91.5Zm60.8-.38c0,1.65-.48,2.19-2.16,2.18q-27.28-.08-54.59,0c-1.8,0-2.3-.37-1.48-2.15a13.5,13.5,0,0,0,.78-10.36c-1.88-5.25-.19-10.21.75-15.25.79-4.28,1.7-8.54,2.48-12.83.54-3-.61-4.75-3.57-5.74-1.22-.14-1.59-.8-1.59-2q.06-17.3,0-34.6c0-1.48.56-1.83,1.92-1.82,14.71,0,29.42.05,44.13,0,1.81,0,2,.73,2.06,2.26,0,3-.41,6,.26,8.92,2.89,1.1,5.89.37,8.84.46,1.65.05,2.17.48,2.17,2.17Q83,56.72,83.05,91.12Z"/><path d="M22.25,6.56c.72-.58,1.57-.35,2.36-.35q23.05,0,46.11,0c.77,0,1.65-.34,2.3.43Z"/><path d="M21.07,47a13.9,13.9,0,0,0,.25-4.31c0-11.14,0-22.27,0-33.4,0-1-.63-2.27.92-2.77a9.2,9.2,0,0,0-.48,3.75q0,16.86,0,33.73C21.78,45,22.21,46.22,21.07,47Z"/><path d="M54.54,53.09c-6.82,0-13.64,0-20.46,0-.77,0-2,.56-2.15-.89-.13-1.6,1.18-1.31,2.12-1.31q20.6,0,41.2,0c.84,0,2-.31,2,1.12s-1.19,1.08-2,1.08C68.37,53.1,61.46,53.09,54.54,53.09Z"/><path d="M54.81,74.4c6.73,0,13.46,0,20.19,0,1,0,2.5-.53,2.37,1.29-.12,1.55-1.53,1-2.4,1q-20.17.06-40.36,0c-.86,0-2.28.57-2.37-1-.11-1.82,1.44-1.26,2.39-1.27C41.36,74.38,48.09,74.4,54.81,74.4Z"/><path d="M43.18,37.88c3.17,0,6.35,0,9.52,0,.9,0,1.91-.13,1.85,1.3,0,1.26-1,1.11-1.76,1.11q-9.52,0-19,0c-.91,0-2,.09-1.87-1.3s1.2-1.11,2.06-1.11C37,37.86,40.09,37.88,43.18,37.88Z"/><path d="M43.08,60H33.57c-.85,0-1.71,0-1.72-1.2s.89-1.18,1.72-1.18H52.86c.81,0,1.69,0,1.69,1.2S53.69,60,52.86,60Z"/><path d="M67.65,40.3c-2.64,0-5.28,0-7.91,0-.88,0-1.93.17-1.91-1.27,0-1.25.93-1.14,1.73-1.14,5.37,0,10.73,0,16.1,0,.88,0,1.7.09,1.66,1.26s-.94,1.15-1.76,1.16C72.92,40.31,70.28,40.3,67.65,40.3Z"/><path d="M67.4,60H59.5c-.84,0-1.69,0-1.67-1.21s.91-1.18,1.71-1.18H75.62c.83,0,1.73,0,1.7,1.2S76.41,60,75.58,60Z"/><path d="M51.54,30.1c-3.18,0-6.37,0-9.55,0-.76,0-1.74.25-1.78-1.05s.87-1.18,1.68-1.18H61c.84,0,1.72,0,1.65,1.22s-1.08,1-1.82,1C57.73,30.12,54.63,30.1,51.54,30.1Z"/><path d="M62.3,83.2c-2.27,0-4.53,0-6.79,0-.69,0-1.55.14-1.61-.94S54.62,81,55.51,81H69.09c.91,0,1.67.15,1.61,1.3s-.92.94-1.61,1C66.83,83.22,64.56,83.2,62.3,83.2Z"/><path d="M69.08,47.1H62.81c-.78,0-1.47-.11-1.5-1.12s.6-1.2,1.41-1.2H75.79c.76,0,1.49.05,1.51,1.09,0,1.21-.85,1.21-1.69,1.21Z"/><path d="M69.3,66.78c-2.18,0-4.36,0-6.54,0-.81,0-1.43-.18-1.45-1.18s.69-1.1,1.46-1.1H75.84c.76,0,1.49,0,1.46,1.11s-.67,1.17-1.47,1.17Z"/><path d="M51.53,20.38c2,0,4,0,6,0,.79,0,1.73-.12,1.82,1.08s-.83,1.21-1.64,1.21H45.19c-.81,0-1.74.08-1.69-1.17s1-1.11,1.78-1.12C47.36,20.36,49.44,20.38,51.53,20.38Z"/><path d="M53.1,44.81c1.45,0,2.89,0,4.33,0,.78,0,1.44.12,1.4,1.16,0,.83-.5,1.09-1.22,1.09H48.15c-.7,0-1.22-.21-1.27-1-.06-1,.54-1.21,1.36-1.21Z"/><path d="M52.88,66.77H48.26c-.82,0-1.41-.21-1.41-1.21s.52-1,1.23-1h9.51c.69,0,1.24.11,1.26,1s-.51,1.25-1.35,1.25Z"/><path d="M37.68,66.76H33.05c-.78,0-1.12-.44-1.15-1.19s.5-1.06,1.22-1h9.53c.76,0,1.2.27,1.15,1.12a1.06,1.06,0,0,1-1.21,1.13Z"/><path d="M37.8,47.06c-1.54,0-3.08,0-4.62,0C32.45,47,32,46.71,32,45.9s.53-1.08,1.23-1.08h9.24c.68,0,1.27.14,1.31,1s-.51,1.26-1.36,1.25Z"/>
                                </g>
                            </g>
                        </svg>
                        <p>
                            <?php echo $cantidad . " " ?> Aplicaciones a vacantes
                        </p>
                    </div>
                    <div class="cont_bnt_der">
                        <button id="btn_hv_vigi">
                            Ver Hoja de Vida
                        </button>
                        <button id="btn_bus_ofer_sliter_natural">
                            Buscar Ofertas
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div class="">
                <div class="container">

                    <div class="row g-2">

                        <div class="col-md">

                            <div class="container cont-ifm m-1 p-2">

                                <h3>
                                    ESTUDIOS
                                </h3>

                                <div class="estu" id="estu">

                                </div>

                            </div>

                        </div>

                        <div class="col-md">

                            <div class="container cont-ifm m-1 p-2">

                                <h3>
                                    CAPACITACIONES                        
                                </h3>

                                <div class="cont_ref_per" id="expe_capa">
                                    
                                </div>

                            </div>

                        </div>
                    
                    </div>


                    <div class="row g-2">

                        <div class="col-md">

                            <div class="container cont-ifm m-1 p-2" id="cont_cuali">

                                <h3>
                                    CUALIFICACIONES
                                </h3>

                                <div class="cuali" id="cuali">
                                    
                                </div> 

                            </div>

                        </div>

                        <div class="col-md">

                            <div class="container cont-ifm m-1 p-2">

                                <h3>
                                    OTROS: CURSOS, SEMINARIOS Y DIPLOMADOS
                                </h3>

                                <div class="cont_ref_per" id="expe_otro">
                                    
                                </div>

                            </div>
                        </div>
                    
                    </div>

                    <div class="row">

                        <div class="col-md">
                            <div class="container cont-ifm m-1 p-2">

                                <h3>
                                    REFERENCIAS PERSONALES
                                </h3>

                                <div class="cont_ref_per" id="expe_per">
                                    
                                </div>

                            </div>
                        </div>

                        <div class="col-md">

                        </div>

                    </div>

                    
                </div>
            </div>
        </section>
    </main>

    <!-- ////////////////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////// MEIN CUERPO EDITABLE ////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////////////////// -->

    <main class="cuerpo" id="cuerpo_2" style="display:none">
        <form id="form_act">

            <!-- SECCION DE FOTO E INFORMACIÓN GENERAL -->
            <section class="cuerpo_sliter">
                <div class="container_div">

                    <div class="inf_usuario">

                        <!-- Foto, contenedor del input y la camara -->
                        <div class="div_inf_foto">
							<div>
								<div class="registro_foto">

                                    <!-- Foto desde el servidor -->
									<div class="img_preview">
										<img src="<?php echo '../'. $_SESSION["fot_nat"]; ?>" id="preview_pn">
									</div>

                                    <!-- Contenedor del input y camara -->
									<div class="registro_img w-100">

                                        <!-- Input -->
										<div>
											<span class="archivo reg__oculto">
												<input  type="file" name="archivo_pn" id="archivo_pn" >
											</span>
										</div>

                                        <!-- Camara del label -->
										<label for="archivo_pn">
											<span class="reg__vis__archivo">
													<img src="../../img/registro 1/CAMARA.svg" alt="">
											</span>
										</label>
									</div>

                                </div>
                            </div>
                        </div>

                        <!-- Informacion general de contacto -->
                        <div class="container">

                            <div class="row g-4 m-0 p-0">

                                <!-- Primero nombre -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <input type="text" id="primer_nombre_pn" class="form-control m-1 w-100" name="primer_nombre_pn" placeholder="Primer nombre"   value="<?php echo $_SESSION["pri_nom"]; ?>" oninput="this.value = this.value.toUpperCase()">
                                        <label for="primer_nombre_pn">Primero nombre</label>
                                    
                                    </div>
                                </div>

                                <!-- Segundo nombre -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <input type="text" id="segundo_nombre_pn" class="form-control m-1 w-100" name="segundo_nombre_pn" placeholder="Segundo nombre"   value="<?php echo $_SESSION["seg_nom"]; ?>" oninput="this.value = this.value.toUpperCase()">
                                        <label for="segundo_nombre_pn">Segundo nombre</label>
                                    
                                    </div>
                                </div>

                                <!-- Primer apellido -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <input type="text"  id="primer_apellido_pn" class="form-control m-1 w-100"  name="primer_apellido_pn" placeholder="Primer apellido" value="<?php echo $_SESSION["pri_ape"]; ?>" oninput="this.value = this.value.toUpperCase()">
                                        <label for="primer_apellido_pn">Primero apellido</label>
                                    
                                    </div>
                                </div>

                                <!-- Segundo apellido -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <input type="text" id="segundo_apellido_pn" class="form-control m-1 w-100" name="segundo_apellido_pn" placeholder="Segundo apellido"   value="<?php echo $_SESSION["seg_ape"]; ?>" oninput="this.value = this.value.toUpperCase()">
                                        <label for="segundo_nombre_pn">Segundo apellido</label>
                                    
                                    </div>
                                </div>
                                
                            </div>

                            <!-- Informacion de contacto -->
                            <div class="row g-2 m-0 p-0">
                                
                                <div class="col-md m-1 p-0">

                                    <div class="input-group ">

                                        <!-- Tipo de documento -->
                                        <div class="form-floating" style="width: 40%">

                                            <select id="tipo_de_documento_pn"  class="form-select m-1 w-100" name="tipo_de_documento_pn"  aria-label="documento">
                                                <option value="--">-</option>
                                                <option value="CC" <?php if ($_SESSION["tip_doc"] == "CC") { echo "selected"; } ?>>CC (Cedula de ciudadania)</option>
                                                <option value="CE" <?php if ($_SESSION["tip_doc"] == "CE") { echo "selected"; } ?>>CE (Cedula de extrangeria)</option>
                                                <option value="PA" <?php if ($_SESSION["tip_doc"] == "PA") { echo "selected"; } ?>>PA (Pasaporte)</option>
                                                <option value="PPT" <?php if ($_SESSION["tip_doc"] == "PPT") { echo "selected"; } ?>>PPT (Permiso por proteccion temporal)</option>
                                            </select>
                                            <label for="tipo_de_documento_pn">Documento</label>

                                        </div>

                                        <!-- Numero de documento -->
                                        <div class="form-floating" style="width: 60%">

                                            <input type="number" id="cedula_de_ciudadania_pn"  class="form-control m-1 w-100" name="cedula_de_ciudadania_pn" placeholder="Numero de documento" disabled value="<?php echo $_SESSION["num_doc"]; ?>">
                                            <label for="cedula_de_ciudadania_pn">Numero documento</label>

                                        </div>

                                    </div>

                                </div>

                                <!-- Correo electronico -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <input type="text"  id="correo_pn" class="form-control m-1 w-100" name="correo_pn" placeholder="Dirección de residencia" value="<?php echo $_SESSION["correo"]; ?>">
                                        <label for="correo_pn">Correo</label>

                                    </div>
                                </div>

                            </div>

                            <div class="row g-4 m-0 p-0">

                                <!-- Departamento -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <select id="departamento_pn" class="form-control w-100 m-1" aria-label="departamento">
                                            <option value="--">-</option>
                                            <?php
                                                foreach ($insert_dp as $departamento) {
                                                    echo "<option value='" . $departamento->cod_dep . "' " . ($_SESSION["departamento"] == $departamento->cod_dep ? "selected" : "") . ">" . $departamento->departamento . "</option>";
                                                }  
                                            ?>
                                        </select>
                                        <label for="departamento_pn">Departamento</label>

                                    </div>
                                </div>


                                <!-- Municipio -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating w-100">

                                        <select id="municipio_pn" class="form-control w-100 m-1"  aria-label="municipio">
                                            <option value="--">-</option>
                                        </select>
                                        <label for="municipio_pn">Municipio</label>

                                    </div>
                                </div>

                                <!-- Dirección -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <input type="text" id="direccion_pn" class="form-control m-1 w-100" name="direccion_pn"  placeholder="Dirección de residencia"  value="<?php echo $_SESSION["dir_nat"]; ?>">
                                        <label for="direccion_pn">Dirección</label>

                                    </div>
                                </div>

                                <!-- Numero telefonico -->
                                <div class="col-md m-1 p-0">
                                    <div class="form-floating">

                                        <input type="number" id="celular_cont_pn" class="form-control m-1 w-100" name="celular_cont_pn"  placeholder="Celular"  value="<?php echo $_SESSION["tel_nat"]; ?>"> 
                                        <label for="celular_cont_pn">Numero telefonico</label>

                                    </div>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                    <!-- Boton de estado y boton de guardado -->
                    <div id="cont_btn" class="cuerpo_sliter_btn" >

                        <!-- Boton de estado laboral -->
						<div class="cont_dese">
                            <div class="check_btn">
                                <label id="estado_des_2" class="estado_des">Desempleado(a)</label>
                                <div class="wrap-toggle">
                                    <input type="checkbox" id="estado_2" class="offscreen estado">
                                    <label for="estado_2" class="swith"></label>
                                </div>
                            </div>
                        </div>

                        <!-- Boton de guadado del formulario de edicion -->
                        <button type="submit">
                            Guardar
                        </button>

                    </div>
                </div>
            </section>
            
            <section class="container mt-4">
                <div class="row g-2">
                    <div class="col-md">
                    
                        <div class="container cont-ifm m-1">
                            
                            <h3 class="pt-3">
                                SOBRE MI
                            </h3>

                            <!-- DESCRIPCION DE PERFIL PROFESIONAL -->
                            <div class="cont-fre m-1 p-2">
                                <div class="form-floating">

                                    <textarea id="contacto_area_pn" class="form-control w-100 m-1" style="height: 200px; resize: none;" name="contacto_area_pn"  placeholder="Perfil profesional"><?php echo $_SESSION["des_nat"]; ?></textarea>
                                    <label for="contacto_area_pn" class="label-text-area">Perfil profesional</label>

                                </div>
                            </div>    

                        </div>

                        <!-- EXPERIENCIA LABORAL -->
                        <div class="container cont-ifm m-1 p-2">

                            <h3 class="pt-3">
                                EXPERIENCIA LABORAL
                            </h3>

                            <!-- PRIMERA REFERENCIA LABORARL -->
                            <div id="expe_lab_1" class="cont-fre m-1 p-2" >

                                <!-- Nombre de la empresa -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="nombre_empresa_pn" class="form-control" name="nombre_empresa_pn"  placeholder="Nombre de la empresa" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? $insert_lab_ob[0]->nom_empresa : "")); ?>">
                                    <label for="nombre_empresa_pn">Nombre de empresa</label>
                                </div>

                                <!-- Tipo de cargo -->
                                <div class="form-floating mb-2">
                                    <select id="tip_car_1" class="form-select" name="tip_car_1">
                                        <option value="--">-</option>
                                        <option value="01" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->cod_cargo === "01") ? "selected" : "")); ?>>Vigilante</option>
                                        <option value="02" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->cod_cargo === "02") ? "selected" : "")); ?>>Supervisor</option>
                                        <option value="03" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->cod_cargo === "03") ? "selected" : "")); ?>>Escolta</option>
                                        <option value="04" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->cod_cargo === "04") ? "selected" : "")); ?>>Operador de medios</option>
                                        <option value="05" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->cod_cargo === "05") ? "selected" : "")); ?>>Operador Canino</option>
                                        <option value="06" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->cod_cargo === "06") ? "selected" : "")); ?>>Otro</option>
                                    </select>
                                    <label for="tip_car_1">Tipo de cargo</label>  
                                </div>

                                <!-- Cargo desempeñado -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="cargo_pn" class="form-control" name="cargo_pn"  placeholder="Cargo" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? $insert_lab_ob[0]->cargo : "")); ?>">
                                    <label for="cargo_pn">Cargo</label>
                                </div>

                                <!-- Tiempo de ingreso -->
                                <div class="form-floating mb-2">
                                    <input type="date" id="tiempo_ingreso_exp_pn" name="tiempo_ingreso_pn" class="form-control"  placeholder="Fecha de ingreso" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? $insert_lab_ob[0]->tie_ingreso : "")); ?>">
                                    <label for="tiempo_ingreso_exp_pn">Tiempo de ingreso</label>
                                </div>

                                <!-- Sigue trabajando -->
                                <div class="form-floating mb-2" >
                                    <select id="y_work_pn" class="form-select" name="y_work_pn">
                                        <option value="--">-</option>
                                        <option value="si" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->sig_trab === "si") ? "selected" : "")); ?>>Si</option>
                                        <option value="no" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab > 0 && $insert_lab_ob[0]->sig_trab === "no") ? "selected" : "")); ?>>No</option>
                                    </select>
                                    <label for="y_work_pn">Sigue trabajando</label>  
                                </div>

                                <!-- Tiempo de salida -->
                                <div id="tiempo_salida_container" class="form-floating mb-2" style="<?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[0]->sig_trab === "si") ? "display:none" : "")); ?>">
                                    <input type="date" id="tiempo_salida_1_pn" class="form-control" name="tiempo_salida_pn" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? $insert_lab_ob[0]->tie_salida : "")); ?>">  
                                    <label for="tiempo_salida_1_pn">Tiempo de salida</label>
                                </div>

                                <!-- Nombre jefe inmediato -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="jefe_inmediato_pn" class="form-control" name="jefe_inmediato_pn"  placeholder="Jefe inmediato" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? $insert_lab_ob[0]->jefe_inmediato : "")); ?>">
                                    <label for="jefe_inmediato_pn">Jefe inmediato</label>
                                </div>

                                <!-- Telefono de contacto -->
                                <div class="form-floating mb-2">
                                    <input type="tel" id="celular_exp_pn" class="form-control" name="numero_pn"  placeholder="Celular" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? $insert_lab_ob[0]->tele_jefe : "")); ?>">
                                    <label for="celular_exp_pn">Telefono de contacto</label>
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? ($insert_lab_ob[0] -> comp_lab === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0? ($insert_lab_ob[0] -> comp_lab === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="comp_rl_pn" name="comp_rl_pn" class="custom-file-input btn-file-be w-100 m-1" data-certificado="<?php echo ($cantidad_lab === 0 ? "no" : ($cantidad_lab > 0 ? $insert_lab_ob[0] -> comp_lab !== null ? "si" : "no" : "no")); ?>"   style="display:none" >
                                        <label for="comp_rl_pn" id="lbl_comp_rl_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? ($insert_lab_ob[0] -> comp_lab === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? ($insert_lab_ob[0] -> comp_lab === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab > 0 ? $insert_lab_ob[0] -> comp_lab : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>

                                <!-- Input con id de la referencia laboral -->
                                <input type="hidden" id="val_exp_lab_1" name="val_exp_lab_1" value="<?php echo ($cantidad_lab === 0 ? "0" : ($cantidad_lab > 0 ? $insert_lab_ob[0]->id_ref_lab : "0")); ?>">
                            
                            </div>

                            <!-- SEGUNDA REFERENCIA LABORAL -->
                            <div id="expe_lab_2" class="cont-fre m-1 p-2" style="<?php echo $cantidad_lab === 2 ? "display:block" : "display:none" ;?>">

                                <!-- Nombre de la empresa -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="nombre_empresa_2_pn" class="form-control" name="nombre_empresa_pn"  placeholder="Nombre de la empresa"  value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? $insert_lab_ob[1]->nom_empresa : "")); ?>">
                                    <label for="nombre_empresa_2_pn">Nombre de empresa</label>
                                </div>

                                <!-- Tipo de cargo -->
                                <div class="form-floating mb-2">
                                    <select id="tip_car_2" class="form-select" name="tip_car_2">
                                        <option value="--">-</option>
                                        <option value="01" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->cod_cargo === "01") ? "selected" : "")); ?>>Vigilante</option>
                                        <option value="02" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->cod_cargo === "02") ? "selected" : "")); ?>>Supervisor</option>
                                        <option value="03" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->cod_cargo === "03") ? "selected" : "")); ?>>Escolta</option>
                                        <option value="04" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->cod_cargo === "04") ? "selected" : "")); ?>>Operador de medios</option>
                                        <option value="05" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->cod_cargo === "05") ? "selected" : "")); ?>>Operador Canino</option>
                                        <option value="06" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->cod_cargo === "06") ? "selected" : "")); ?>>Otro</option>
                                    </select>
                                    <label for="tip_car_2">Tipo de cargo</label>  
                                </div>

                                <!-- Cargo desempeñado -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="cargo_2_pn" class="form-control" name="cargo_pn" placeholder="Cargo" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? $insert_lab_ob[1]->cargo : "")); ?>">
                                    <label for="cargo_2_pn">Cargo</label>
                                </div>

                                <!-- Tiempo de ingreso -->
                                <div class="form-floating mb-2">
                                    <input type="date" id="tiempo_ingreso_exp_2_pn" class="form-control" name="tiempo_ingreso_pn" placeholder="Fecha de ingreso" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? $insert_lab_ob[1]->tie_ingreso : "")); ?>">
                                    <label for="tiempo_ingreso_exp_2_pn">Tiempo de ingreso</label>
                                </div>

                                <!-- Sigue trabajando -->
                                <div class="form-floating mb-2">
                                    <select id="y_work_2_pn" class="form-select" name="y_work_2_pn">
                                        <option value="--">-</option>
                                        <option value="si" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->sig_trab === "si") ? "selected" : "")); ?>>Si</option>
                                        <option value="no" <?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->sig_trab === "no") ? "selected" : "")); ?>>No</option>
                                    </select>
                                    <label for="y_work_2_pn">Sigue trabajando</label>  
                                </div>

                                <!-- Tiempo de salida -->
                                <div id="tiempo_salida_container_2" class="form-floating mb-2" style="<?php echo ($cantidad_lab === 0 ? "" : (($cantidad_lab === 2 && $insert_lab_ob[1]->sig_trab === "si") ? "display:none" : "")); ?>">
                                    <input type="date" id="tiempo_salida_2_pn" class="form-control" name="tiempo_salida_pn" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? $insert_lab_ob[1]->tie_salida : "")); ?>">  
                                    <label for="tiempo_salida_2_pn">Tiempo de salida</label>  
                                </div>

                                <!-- Nombre jefe inmediato -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="jefe_inmediato_2_pn" class="form-control" name="jefe_inmediato_pn"  placeholder="Jefe inmediato" value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? $insert_lab_ob[1]->jefe_inmediato : "")); ?>">
                                    <label for="jefe_inmediato_2_pn">Jefe inmediato</label>
                                </div>

                                <!-- Telefono de contacto -->
                                <div class="form-floating mb-2">
                                    <input type="tel" id="celular_exp_2_pn" class="form-control" name="numero_pn" placeholder="Celular"  value="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? $insert_lab_ob[1]->tele_jefe : "")); ?>">
                                    <label for="celular_exp_2_pn">Telefono de contacto</label>
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? ($insert_lab_ob[1] -> comp_lab === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2? ($insert_lab_ob[1] -> comp_lab === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="comp_rl_2_pn" name="comp_rl_2_pn" class="custom-file-input btn-file-be w-100 m-1" data-certificado="<?php echo ($cantidad_lab === 0 ? "no" : ($cantidad_lab === 2 ? $insert_lab_ob[1] -> comp_lab !== null ? "si" : "no" : "no")); ?>" style="display:none" >
                                        <label for="comp_rl_2_pn" id="lbl_comp_rl_2_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? ($insert_lab_ob[1] -> comp_lab === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? ($insert_lab_ob[1] -> comp_lab === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_lab === 0 ? "" : ($cantidad_lab === 2 ? $insert_lab_ob[1] -> comp_lab : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>  

                                <!-- Input con id de la referencia laboral -->
                                <input type="hidden" id="val_exp_lab_2" name="val_exp_lab_2" value="<?php echo ($cantidad_lab === 0 ? "0" : ($cantidad_lab === 2 ? $insert_lab_ob[1]->id_ref_lab : "0"));?>">

                            </div>

                            <!-- BOTON PARA AGREGAR SEGUNDA REFERENCIA LABORAL -->
                            <div class="cont_add_btn" style="<?php echo $cantidad_lab !== 2 ? "display:block" : "display:none" ;?>">
                                <button id="insert_exp_lab_2" class="insertar_form">
                                    <img src="../../img/registro 1/icono de +.svg" alt="">
                                </button>
                            </div>

                        </div>
                    </div>
                
                    <!-- MUESTRA DE VACANTES Y HOJA DE VIDA -->
                    <div class="col-md dfx">
                        <div class="cont_cuer_der">
                            <!-- Icono de libre para seccion de vacante -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.96 95.62">
                                <title>icono vacantesRecurso 6</title>
                                <g id="Capa_2_vaca" data-name="Capa 2">
                                    <g id="Capa_1-2_vaca" data-name="Capa 1">
                                        <path d="M8.64,12.64c0,3.09,0,6.18,0,9.27,0,.8.13,1.72-1.14,1.72s-1.16-.91-1.17-1.71q0-9.42,0-18.82c0-.83-.05-1.72,1.17-1.73s1.14.91,1.15,1.72Z"/><path d="M90.74,22.56c0-3.08,0-6.16,0-9.25,0-.78-.18-1.75,1.11-1.73s1,1,1,1.77c0,6.26,0,12.51,0,18.77,0,.76.22,1.76-1.08,1.74s-1.06-1-1.07-1.78C90.73,28.91,90.74,25.73,90.74,22.56Z"/><path d="M8.66,31.32c0,1.1.18,2.19-1.27,2.06-1.61-.15-1-1.45-1.07-2.32s-.12-2,1.28-1.85C9.28,29.34,8.32,30.75,8.66,31.32Z"/><path d="M93,41.62c-.17.8.34,2-1.12,2s-1.13-1.17-1.12-2-.3-2.24,1.27-2.13C93.38,39.59,92.75,40.85,93,41.62Z"/><path d="M72,19.69c-1.16-2.78-.38-5.69-.46-8.53,0-1.82-.42-2.51-2.4-2.5q-21.53.12-43,0c-2,0-2.38.74-2.37,2.53.07,11,0,22,0,33,0,1.25.05,2.35,1.46,2.82-1.51.22-1.88-.61-1.88-1.92,0-11.54.05-23.08,0-34.61,0-2.22,1.25-2.21,2.82-2.2q17.58,0,35.15,0c2.73,0,5.45.08,8.17,0,1.86-.07,2.64.54,2.56,2.48C71.94,13.69,72,16.7,72,19.69Z"/><path d="M85.33,20.25c0-1,0-2.09-1-2.7-3.21-2.08-3.55-5.17-3.29-8.59.16-2-.08-4,.06-6C81.3.68,80.41,0,78.15,0Q48.39.13,18.64,0c-2.55,0-3,.89-3,3.16.1,11.74,0,23.48.07,35.22a5.65,5.65,0,0,1-1.36,4C10.2,47.38,6.15,52.53,2,57.58A8.15,8.15,0,0,0,0,63.08c0,9.92.1,19.84,0,29.76,0,2.39.8,2.8,3,2.78,13.1-.1,26.21-.05,39.31-.05,13.38,0,26.76,0,40.13,0,2,0,3-.46,3-2.72Q85.27,56.57,85.33,20.25Zm-4.64-2.66c-1.9.63-3.86.24-5.8.25-.79,0-1-.6-1-1.3V10.37ZM20.6,2.2q27.71.13,55.4,0c2.15,0,2.92.57,2.73,2.74s0,4.09,0,6.49C76.32,9.9,75.11,7.75,73,6.65a2.74,2.74,0,0,0-1.84-.28H23.85a3.49,3.49,0,0,0-1.6.2l0,0c-1.05.81-.76,2-.76,3,0,11.54,0,23.08,0,34.63,0,.93.47,2-.41,2.82-1.24.16-1.83,1.34-2.76,2-.6-.69-.36-1.35-.36-2,0-14,0-28-.06-42C17.88,2.89,18.38,2.19,20.6,2.2Zm1.65,89.3a2.93,2.93,0,0,1-3,1.8c-4.91-.09-9.83-.1-14.74,0-1.83,0-2.32-.63-2.31-2.38.07-9.19,0-18.38,0-27.57a4.93,4.93,0,0,1,.67-3.16C7,55.09,11.05,50,15.64,44.33c0,5.9.11,11-.05,16a5.06,5.06,0,0,1-3.23,4.92,6.85,6.85,0,0,0-1.93,1.49c-.45.41-1.06.92-.33,1.57.47.42,1,.74,1.69.22C14.54,66.45,17.74,65,18,60.65c.17-3.12,1.37-6.18,2.13-9.26.53-2.13,1.89-3.07,4.05-2.58s2.85,2,2.41,4.12q-2.09,10.27-4.12,20.55A8.91,8.91,0,0,0,22.73,78C24.13,82.53,24.71,87.06,22.25,91.5Zm60.8-.38c0,1.65-.48,2.19-2.16,2.18q-27.28-.08-54.59,0c-1.8,0-2.3-.37-1.48-2.15a13.5,13.5,0,0,0,.78-10.36c-1.88-5.25-.19-10.21.75-15.25.79-4.28,1.7-8.54,2.48-12.83.54-3-.61-4.75-3.57-5.74-1.22-.14-1.59-.8-1.59-2q.06-17.3,0-34.6c0-1.48.56-1.83,1.92-1.82,14.71,0,29.42.05,44.13,0,1.81,0,2,.73,2.06,2.26,0,3-.41,6,.26,8.92,2.89,1.1,5.89.37,8.84.46,1.65.05,2.17.48,2.17,2.17Q83,56.72,83.05,91.12Z"/><path d="M22.25,6.56c.72-.58,1.57-.35,2.36-.35q23.05,0,46.11,0c.77,0,1.65-.34,2.3.43Z"/><path d="M21.07,47a13.9,13.9,0,0,0,.25-4.31c0-11.14,0-22.27,0-33.4,0-1-.63-2.27.92-2.77a9.2,9.2,0,0,0-.48,3.75q0,16.86,0,33.73C21.78,45,22.21,46.22,21.07,47Z"/><path d="M54.54,53.09c-6.82,0-13.64,0-20.46,0-.77,0-2,.56-2.15-.89-.13-1.6,1.18-1.31,2.12-1.31q20.6,0,41.2,0c.84,0,2-.31,2,1.12s-1.19,1.08-2,1.08C68.37,53.1,61.46,53.09,54.54,53.09Z"/><path d="M54.81,74.4c6.73,0,13.46,0,20.19,0,1,0,2.5-.53,2.37,1.29-.12,1.55-1.53,1-2.4,1q-20.17.06-40.36,0c-.86,0-2.28.57-2.37-1-.11-1.82,1.44-1.26,2.39-1.27C41.36,74.38,48.09,74.4,54.81,74.4Z"/><path d="M43.18,37.88c3.17,0,6.35,0,9.52,0,.9,0,1.91-.13,1.85,1.3,0,1.26-1,1.11-1.76,1.11q-9.52,0-19,0c-.91,0-2,.09-1.87-1.3s1.2-1.11,2.06-1.11C37,37.86,40.09,37.88,43.18,37.88Z"/><path d="M43.08,60H33.57c-.85,0-1.71,0-1.72-1.2s.89-1.18,1.72-1.18H52.86c.81,0,1.69,0,1.69,1.2S53.69,60,52.86,60Z"/><path d="M67.65,40.3c-2.64,0-5.28,0-7.91,0-.88,0-1.93.17-1.91-1.27,0-1.25.93-1.14,1.73-1.14,5.37,0,10.73,0,16.1,0,.88,0,1.7.09,1.66,1.26s-.94,1.15-1.76,1.16C72.92,40.31,70.28,40.3,67.65,40.3Z"/><path d="M67.4,60H59.5c-.84,0-1.69,0-1.67-1.21s.91-1.18,1.71-1.18H75.62c.83,0,1.73,0,1.7,1.2S76.41,60,75.58,60Z"/><path d="M51.54,30.1c-3.18,0-6.37,0-9.55,0-.76,0-1.74.25-1.78-1.05s.87-1.18,1.68-1.18H61c.84,0,1.72,0,1.65,1.22s-1.08,1-1.82,1C57.73,30.12,54.63,30.1,51.54,30.1Z"/><path d="M62.3,83.2c-2.27,0-4.53,0-6.79,0-.69,0-1.55.14-1.61-.94S54.62,81,55.51,81H69.09c.91,0,1.67.15,1.61,1.3s-.92.94-1.61,1C66.83,83.22,64.56,83.2,62.3,83.2Z"/><path d="M69.08,47.1H62.81c-.78,0-1.47-.11-1.5-1.12s.6-1.2,1.41-1.2H75.79c.76,0,1.49.05,1.51,1.09,0,1.21-.85,1.21-1.69,1.21Z"/><path d="M69.3,66.78c-2.18,0-4.36,0-6.54,0-.81,0-1.43-.18-1.45-1.18s.69-1.1,1.46-1.1H75.84c.76,0,1.49,0,1.46,1.11s-.67,1.17-1.47,1.17Z"/><path d="M51.53,20.38c2,0,4,0,6,0,.79,0,1.73-.12,1.82,1.08s-.83,1.21-1.64,1.21H45.19c-.81,0-1.74.08-1.69-1.17s1-1.11,1.78-1.12C47.36,20.36,49.44,20.38,51.53,20.38Z"/><path d="M53.1,44.81c1.45,0,2.89,0,4.33,0,.78,0,1.44.12,1.4,1.16,0,.83-.5,1.09-1.22,1.09H48.15c-.7,0-1.22-.21-1.27-1-.06-1,.54-1.21,1.36-1.21Z"/><path d="M52.88,66.77H48.26c-.82,0-1.41-.21-1.41-1.21s.52-1,1.23-1h9.51c.69,0,1.24.11,1.26,1s-.51,1.25-1.35,1.25Z"/><path d="M37.68,66.76H33.05c-.78,0-1.12-.44-1.15-1.19s.5-1.06,1.22-1h9.53c.76,0,1.2.27,1.15,1.12a1.06,1.06,0,0,1-1.21,1.13Z"/><path d="M37.8,47.06c-1.54,0-3.08,0-4.62,0C32.45,47,32,46.71,32,45.9s.53-1.08,1.23-1.08h9.24c.68,0,1.27.14,1.31,1s-.51,1.26-1.36,1.25Z"/>
                                    </g>
                                </g>
                            </svg>

                            <!-- Cantidad de vacantes que se encuentra postulado -->
                            <p>
                                <?php echo $cantidad . " " ?> Aplicaciones a vacantes
                            </p>
                        </div>

                        <!-- Botones de creacion de hoja de vida y buscar ofertas -->
                        <div class="cont_bnt_der">

                            <!-- Boton ver hoja de vida -->
                            <button id="btn_hv_vigi_2">
                                Ver Hoja de Vida
                            </button>

                            <!-- Boton buscar oferta -->
                            <button id="btn_bus_ofer_sliter_natural">
                                Buscar Ofertas
                            </button>
                            
                        </div>
                    </div>           
                </div>
            </section>

            <section class="container">
                <div class="row g-2">

                    <!-- EDUCACION FORMAL -->
                    <div class="col-md">
                        <div  id="cont_estu" class="container cont-ifm m-1 p-2">

                            <h3 class="pt-3">
                                ESTUDIOS
                            </h3>

                            <!-- PRIMERA EDUCACIÓN FORMAL -->
                            <div id="ref_est_1" class="cont-fre m-1 p-2" >

                                <!-- Nombre del instituto educativo -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="nombre_instituto_pn" class="form-control" name="nombre_instituto_pn" placeholder="Nombre de instituto" value="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? $insert_est_ob[0] -> nom_insti : "")); ?>">
                                    <label for="nombre_instituto_pn">Nombre del instituto</label>
                                </div>

                                <!-- Nivel academico alcanzado -->
                                <div class="form-floating mb-2">
                                    <select id="nivel_academico_pn" class="form-select" name="nivel_academico_pn">
                                        <option value="">-</option>
                                        <?php
                                            foreach ($inf_na as $nivel) {
                                                echo "<option value='" . $nivel ->  cod_na .  "' " . ($insert_est_ob[0] -> cod_na == $nivel->cod_na ? "selected" : "") . ">" . $nivel -> nivel_academico . "</option>";
                                            }                                        
                                        ?>
                                    </select>
                                    <label for="nivel_academico_pn">Nivel academico</label>
                                </div>

                                <!-- Titulo optenido -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="titulo_op_pn" class="form-control" name="titulo_op_pn"  placeholder="Titulo obtenido" value="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? $insert_est_ob[0] -> titulo : "")); ?>">
                                    <label for="titulo_op_pn">Titulo optenido</label>
                                </div>

                                <!-- Sigue trabajando -->
                                <div class="form-floating mb-2" >
                                    <select id="y_stu_pn" class="form-select" name="y_stu_pn">
                                        <option value="--">-</option>
                                        <option value="si" <?php echo ($cantidad_est === 0 ? "" : (($cantidad_est > 0 && $insert_est_ob[0]->sig_estu === 1) ? "selected" : "")); ?>>Si</option>
                                        <option value="no" <?php echo ($cantidad_est === 0 ? "" : (($cantidad_est > 0 && $insert_est_ob[0]->sig_estu === 0) ? "selected" : "")); ?>>No</option>
                                    </select>
                                    <label for="y_stu_pn">Sigue estudiando</label>  
                                </div>

                                <!-- Fecha de finalizacion -->
                                <div id="tiempo_fin_container" class="form-floating mb-2" >
                                    <input type="date" id="tiempo_fin_1_pn" class="form-control" name="tiempo_fin_1_pn" placeholder="Fecha de fin" value="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? $insert_est_ob[0] -> fec_fin : "")); ?>"> 
                                    <label for="tiempo_fin_1_pn">Fecha de finalización</label> 
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? ($insert_est_ob[0] -> comp_est === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? ($insert_est_ob[0] -> comp_est === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="comp_stu_pn" name="comp_stu_pn" class="custom-file-input btn-file-be w-100 m-1" data-certificado="<?php echo ($cantidad_est === 0 ? "no" : ($cantidad_est > 0 ? $insert_est_ob[0] -> comp_est !== null ? "si" : "no" : "no")); ?>" style="display:none" >
                                        <label for="comp_stu_pn" id="lbl_comp_stu_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? ($insert_est_ob[0] -> comp_est === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? ($insert_est_ob[0] -> comp_est === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est > 0 ? $insert_est_ob[0] -> comp_est : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>  
                                
                                <!-- Input con id de la formacion academica -->
                                <input type="hidden" id="val_1" name="val_1" value="<?php echo ($cantidad_est === 0 ? "0" : ($cantidad_est > 0 ? $insert_est_ob[0] -> id_estu : "0")); ?>">
                            
                            </div>

                            <!-- SEGUNDA EDUCACIÓN FORMAL -->
                            <div id="ref_est_2" class="cont-fre m-1 p-2" style="<?php echo $cantidad_est === 2 ? "display:block" : "display:none" ;?>">

                                <!-- Nombre del instituto educativo -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="nombre_instituto_2_pn" class="form-control" name="nombre_instituto_2_pn" placeholder="Nombre de instituto" value="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2 ? $insert_est_ob[1] -> nom_insti : "")); ?>">
                                    <label for="nombre_instituto_2_pn">Nombre del instituto</label>
                                </div>

                                <!-- Nivel academico alcanzado -->
                                <div class="form-floating mb-2">
                                    <select id="nivel_academico_2_pn" class="form-select" name="nivel_academico_2_pn">
                                        <option value="">-</option>
                                        <?php
                                            foreach ($inf_na as $nivel) {
                                                echo "<option value='" . $nivel ->  cod_na .  "' " . ($insert_est_ob[1] -> cod_na == $nivel->cod_na ? "selected" : "") . ">" . $nivel -> nivel_academico . "</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="nivel_academico_2_pn">Nivel academico</label>
                                </div>

                                <!-- Titulo optenido -->
                                <div class="form-floating mb-2">
                                    <input type="text" id="titulo_op_2_pn" class="form-control" name="titulo_op_2_pn" placeholder="Titulo obtenido"  value="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2 ? $insert_est_ob[1] -> titulo : "")); ?>">
                                    <label for="titulo_op_2_pn">Titulo optenido</label>
                                </div>

                                <!-- Sigue trabajando -->
                                <div class="form-floating mb-2" >
                                    <select id="y_stu_2_pn" class="form-select" name="y_stu_2_pn">
                                        <option value="--">-</option>
                                        <option value="si" <?php echo ($cantidad_est === 0 ? "" : (($cantidad_est === 2 && $insert_est_ob[1]->sig_estu === 1) ? "selected" : "")); ?>>Si</option>
                                        <option value="no" <?php echo ($cantidad_est === 0 ? "" : (($cantidad_est === 2 && $insert_est_ob[1]->sig_estu === 0) ? "selected" : "")); ?>>No</option>
                                    </select>
                                    <label for="y_stu_2_pn">Sigue estudiando</label>  
                                </div>

                                <!-- Fecha de finalizacion -->
                                <div id="tiempo_fin_container_2" class="form-floating mb-2" >
                                    <input type="date" id="tiempo_fin_2_pn" class="form-control" name="tiempo_fin_2_pn" value="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2 ? $insert_est_ob[1] -> fec_fin : "")); ?>">
                                    <label for="tiempo_fin_2_pn">Fecha de finalización</label> 
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2 ? ($insert_est_ob[1] -> comp_est === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2? ($insert_est_ob[1] -> comp_est === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="comp_stu_2_pn" name="comp_stu_2_pn" class="custom-file-input btn-file-be w-100 m-1" data-certificado="<?php echo ($cantidad_est === 0 ? "no" : ($cantidad_est === 2 ? $insert_est_ob[1] -> comp_est !== null ? "si" : "no" : "no")); ?>" style="display:none" >
                                        <label for="comp_stu_2_pn" id="lbl_comp_stu_2_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2 ? ($insert_est_ob[1] -> comp_est === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2 ? ($insert_est_ob[1] -> comp_est === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_est === 0 ? "" : ($cantidad_est === 2 ? $insert_est_ob[1] -> comp_est : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>  

                                <!-- Input con id de la formacion academica -->
                                <input type="hidden" id="val_2" name="val_2" value="<?php echo ($cantidad_est === 0 ? "0" : ($cantidad_est === 2 ? $insert_est_ob[1] -> id_estu : "0")); ?>">

                            </div>   

                            <!-- BOTON PARA AGREGAR SEGUNDA FORMACION ACADEMICA -->
                            <div id="cont_add_btn_est" class="cont_add_btn"  style="<?php echo $cantidad_est !== 2 ? "display:block" : "display:none" ;?>">
                                <button id="insert_est_2" class="insertar_form" >
                                    <img src="../../img/registro 1/icono de +.svg" alt="">
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- CAPACITACION EN VIGILANCIA -->
                    <div class="col-md">
                        <div id="cont_capa" class="container cont-ifm m-1 p-2">

                            <h3 class="pt-3">
                                CAPACITACIONES
                            </h3>

                            <!-- PRIMERA CAPACITACION -->
                            <div  id="ref_cuali_1" class="cont-fre m-1 p-2">

                                <!-- Nombre instituto que certifica -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="" id="lug_capaci_pn" class="form-control" placeholder="Lugar donde se cualifico" value="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap > 0 ? $insert_cap_ob[0] -> lugar : "")); ?>">
                                    <label for="lug_capaci_pn">Nombre del instituto</label>
                                </div>

                                <!-- Nivel de la capacitacion en seguridad -->
                                <div class="form-floating mb-2">
                                    <select name="" id="lug_capacita_pn" class="form-select">
                                        <option value="">-</option>
                                        <?php
                                            foreach ($inf_cc as $niv_cc) {
                                                echo "<option value='" . $niv_cc ->  cod_cap .  "' " . ($insert_cap_ob[0] -> cod_cap == $niv_cc->cod_cap ? "selected" : "") . ">" . $niv_cc -> capacitacion . "</option>";
                                            }                                        
                                        ?>
                                    </select>
                                    <label for="lug_capacita_pn">Capacitacion optenida</label>
                                </div>

                                <!-- Fecha del certificado -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="" id="fech_capacita_pn" class="form-control" value="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap > 0 ? $insert_cap_ob[0] -> fec_cuapa : "")); ?>">
                                    <label for="fech_capacita_pn">Fecha de capacitación</label>
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap > 0 ? ($insert_cap_ob[0] -> doc_cuapa === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap > 0 ? ($insert_cap_ob[0] -> doc_cuapa === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="doc_capacita_pn" name="doc_capacita_pn" data-certificado="<?php echo ($cantidad_cap === 0 ? "no" : ($cantidad_cap > 0 ? $insert_cap_ob[0] -> doc_cuapa !== null ? "si" : "no" : "no")); ?>" class="custom-file-input btn-file-be w-100 m-1" style="display:none" >
                                        <label for="doc_capacita_pn" id="lbl_doc_capacita_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap > 0 ? ($insert_cap_ob[0] -> doc_cuapa === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap > 0 ? ($insert_cap_ob[0] -> doc_cuapa === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap > 0 ? $insert_cap_ob[0] -> doc_cuapa : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>  

                                <!-- Input con id de la capacitacion en seguridad -->
                                <input type="hidden" name="val_cua_1" id="val_cap_1_pn" value="<?php echo ($cantidad_cap === 0 ? "0" : ($cantidad_cap > 0 ? $insert_cap_ob[0] -> id_cuapa : "0")); ?>">

                            </div>

                            <!-- SEGUNDA CAPACITACION -->
                            <div class="cont-fre m-1 p-2" id="ref_capa_2" style="<?php echo $cantidad_cap === 2 ? "display:block" : "display:none" ;?>">
                                
                                <!-- Nombre instituto que certifica -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="" id="lug_capaci_2_pn" class="form-control" placeholder="Lugar donde se cualifico" value="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap === 2 ? $insert_cap_ob[1] -> lugar : "")); ?>">
                                    <label for="lug_capaci_2_pn">Nombre del instituto</label>
                                </div>

                                <!-- Nivel de la capacitacion en seguridad -->
                                <div class="form-floating mb-2">
                                    <select name="" id="lug_capacita_2_pn" class="form-select">
                                        <option value="">-</option>
                                        <?php
                                            foreach ($inf_cc as $niv_cc) {
                                                $selected = "";

                                                if ($cantidad_cap !== 0 && isset($insert_cap_ob[1]) && $insert_cap_ob[1]->cod_cap == $niv_cc->cod_cap) {
                                                    $selected = "selected";
                                                }

                                                echo "<option value='" . $niv_cc->cod_cap . "' $selected>" . $niv_cc->capacitacion . "</option>";
                                            }                                   
                                        ?>
                                    </select>
                                    <label for="lug_capacita_2_pn">Capacitacion optenida</label>
                                </div>

                                <!-- Fecha del certificado -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="" id="fech_capacita_2_pn" class="form-control" value="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap === 2  ? $insert_cap_ob[1] -> fec_cuapa : "")); ?>">
                                    <label for="fech_capacita_2_pn">Fecha de capacitación</label>
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap === 2 ? ($insert_cap_ob[1] -> doc_cuapa === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap === 2 ? ($insert_cap_ob[1] -> doc_cuapa === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="doc_capacita_2_pn" name="doc_capacita_2_pn" data-certificado="<?php echo ($cantidad_cap === 0 ? "no" : ($cantidad_cap === 2 ? $insert_cap_ob[1] -> doc_cuapa !== null ? "si" : "no" : "no")); ?>" class="custom-file-input btn-file-be w-100 m-1" style="display:none" >
                                        <label for="doc_capacita_2_pn" id="lbl_doc_capacita_2_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap === 2 ? ($insert_cap_ob[1] -> doc_cuapa === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap === 2 ? ($insert_cap_ob[1] -> doc_cuapa === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_cap === 0 ? "" : ($cantidad_cap === 2 ? $insert_cap_ob[1] -> doc_cuapa : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>  

                                <!-- Input con id de la capacitacion en seguridad -->
                                <input type="hidden" name="val_cua_2" id="val_cap_2_pn" value="<?php echo ($cantidad_cap === 0 ? "0" : ($cantidad_cap === 2 ? $insert_cap_ob[1] -> id_cuapa : "0")); ?>">
                            
                            </div>

                            <!-- BOTON PARA AGREGAR SEGUNDA CAPACITACION DE SEGURIDAD -->
                            <div class="cont_add_btn" id="cont_add_btn_cap" style="<?php echo $cantidad_cap !== 2 ? "display:block" : "display:none" ;?>">
                                <button class="insertar_form" id="insert_cap_2">
                                    <img src="../../img/registro 1/icono de +.svg" alt="">
                                </button>
                            </div>

                        </div>
                    </div>                
                </div>
            </section>

            <section class="container">
                <div class="row g-2">

                    <!-- CUALIFICACIONES -->
                    <div class="col-md">
                        <div class="container cont-ifm m-1 p-2" id="cont_cuali">

                            <h3 class="pt-3">
                                CUALIFICACIONES
                            </h3>

                            <!-- PRIMERA CUALIFICACION -->
                            <div class="cont-fre m-1 p-2" id="ref_cuali_1">

                                <!-- Nombre del organizmo certificador -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="" id="lug_cuali_pn" class="form-control" placeholder="Lugar donde se cualifico" value="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua > 0 ? $insert_cua_ob[0] -> lugar : "")); ?>">
                                    <label for="lug_cuali_pn">Empresa cualificadora</label>
                                </div>

                                <!-- Cualificacion obtenida -->
                                <div class="form-floating mb-2">
                                    <select name="" id="lug_cualifica_pn" class="form-select">
                                        <option value="">-</option>
                                        <?php
                                            foreach ($inf_cu as $niv_cu) {
                                                echo "<option value='" . $niv_cu ->  cod_cuali .  "' " . ($insert_cua_ob[0] -> cod_cuali == $niv_cu->cod_cuali ? "selected" : "") . ">" . $niv_cu -> cualificacion . "</option>";
                                            }                                        
                                        ?>
                                    </select>
                                    <label for="lug_cualifica_pn">Titulo cualificado</label>
                                </div>

                                <!-- Fecha que se explide la cualificacion -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="" id="fech_cualifi_pn" class="form-control" value="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua > 0 ? $insert_cua_ob[0] -> fec_cualifi : "")); ?>">
                                    <label for="fech_cualifi_pn">Fecha de cualificación</label>
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua > 0 ? ($insert_cua_ob[0] -> doc_cualifi === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua > 0 ? ($insert_cua_ob[0] -> doc_cualifi === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="doc_cualifi_pn" name="doc_cualifi_pn" data-certificado="<?php echo ($cantidad_cua === 0 ? "no" : ($cantidad_cua > 0 ? $insert_cua_ob[0] -> doc_cualifi !== null ? "si" : "no" : "no")); ?>" class="custom-file-input btn-file-be w-100 m-1" style="display:none" >
                                        <label for="doc_cualifi_pn" id="lbl_doc_cualifi_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua > 0 ? ($insert_cua_ob[0] -> doc_cualifi === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua > 0 ? ($insert_cua_ob[0] -> doc_cualifi === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua > 0 ? $insert_cua_ob[0] -> doc_cualifi : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>  

                                <!-- Input que contiene el valor del id de la cualificacion -->
                                <input type="hidden" name="val_cua_1" id="val_cua_1" value="<?php echo ($cantidad_cua === 0 ? "0" : ($cantidad_cua > 0 ? $insert_cua_ob[0] -> id_cualifi : "0")); ?>">
                            
                            </div>

                            <!-- SEGUNDA CUALIFICACION -->
                            <div class="cont-fre m-1 p-2" id="ref_cuali_2" style="<?php echo $cantidad_cua === 2 ? "display:block" : "display:none" ;?>">
                                
                                <!-- Nombre del organizmo certificador -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="" id="lug_cuali_2_pn" class="form-control" placeholder="Lugar donde se cualifico" value="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua === 2 ? $insert_cua_ob[1] -> lugar : "")); ?>">
                                    <label for="lug_cuali_2_pn">Empresa cualificadora</label>
                                </div>

                                <!-- Cualificacion obtenida -->
                                <div class="form-floating mb-2">
                                    <select name="" id="lug_cualifica_2_pn" class="form-select">
                                        <option value="">-</option>
                                        <?php
                                            foreach ($inf_cu as $niv_cu) {
                                                echo "<option value='" . $niv_cu ->  cod_cuali .  "' " . ($insert_cua_ob[1] -> cod_cuali == $niv_cu->cod_cuali ? "selected" : "") . ">" . $niv_cu -> cualificacion . "</option>";
                                            }                                        
                                        ?>
                                    </select>
                                    <label for="lug_cualifica_2_pn">Titulo cualificado</label>
                                </div>

                                <!-- Fecha que se explide la cualificacion -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="" id="fech_cualifi_2_pn" class="form-control" value="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua === 2 ? $insert_cua_ob[1] -> fec_cualifi : "")); ?>">
                                    <label for="fech_cualifi_2_pn">Fecha de cualificación</label>
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua === 2 ? ($insert_cua_ob[1] -> doc_cualifi === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua === 2 ? ($insert_cua_ob[1] -> doc_cualifi === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="doc_cualifi_2_pn" name="doc_cualifi_2_pn" data-certificado="<?php echo ($cantidad_cua === 0 ? "no" : ($cantidad_cua === 2 ? $insert_cua_ob[1] -> doc_cualifi !== null ? "si" : "no" : "no")); ?>" class="custom-file-input btn-file-be w-100 m-1" style="display:none" >
                                        <label for="doc_cualifi_2_pn" id="lbl_doc_cualifi_2_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua === 2 ? ($insert_cua_ob[1] -> doc_cualifi === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua === 2 ? ($insert_cua_ob[1] -> doc_cualifi === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_cua === 0 ? "" : ($cantidad_cua === 2 ? $insert_cua_ob[1] -> doc_cualifi : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>  

                                <!-- Input que contiene el valor del id de la cualificacion -->
                                <input type="hidden" name="val_cua_2" id="val_cua_2" value="<?php echo ($cantidad_cua === 0 ? "0" : ($cantidad_cua === 2 ? $insert_cua_ob[1] -> id_cualifi : "0")); ?>">
                            
                            </div>

                            <!-- BOTON PARA AGREGAR LA SEGUNDA CUALIFICACION -->
                            <div class="cont_add_btn" id="cont_add_btn_cua" style="<?php echo $cantidad_cua !== 2 ? "display:block" : "display:none" ;?>">
                                <button class="insertar_form" id="insert_cua_2">
                                    <img src="../../img/registro 1/icono de +.svg" alt="">
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- OTROS CURSOS, SEMIRARIOS, DIPLOMADOS QUE TENGA -->
                    <div class="col-md">
                        <div class="container cont-ifm m-1 p-2" id="cont_otros">

                            <h3 class="pt-3">
                                OTROS: CURSOS, SEMINARIOS Y DIPLOMADOS
                            </h3>

                            <!-- PRIMERA SECCION DE CURSOS, SEMINARIOS O DIPLOMADOS -->
                            <div class="cont-fre m-1 p-2" id="ref_cuali_1">

                                <!-- Nombre del instituto certificador -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="nom_inst_otro_pn" id="nom_inst_otro_pn" placeholder="Nombre de instituto" class="form-control" value="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? $insert_otr_ob[0] -> nivel_ins_otro : "")); ?>">
                                    <label for="nom_inst_otro_pn">Nombre instituto</label>
                                </div>

                                <!-- Titulo que se certifica -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="titulo" id="tit_op_otro_pn" placeholder="Titulo obtenido" class="form-control" value="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? $insert_otr_ob[0] -> titulo_otro : "")); ?>">
                                    <label for="tit_op_otro_pn">Titulo obtenido</label>
                                </div>

                                <!-- Fecha de expedicion del certificado -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="tiempo_fin_1" id="tie_fin_otro_1_pn" class="form-control" value="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? $insert_otr_ob[0] -> fec_fin_otro : "")); ?>">
                                    <label for="tie_fin_otro_1_pn">Finalización</label> 
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? ($insert_otr_ob[0] -> comp_otro === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? ($insert_otr_ob[0] -> comp_otro === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>">

                                        <input type="file" id="comp_otro_pn" name="comp_otro_pn" data-certificado="<?php echo ($cantidad_otr === 0 ? "no" : ($cantidad_otr > 0 ? $insert_otr_ob[0] -> comp_otro !== null ? "si" : "no" : "no")); ?>" class="custom-file-input btn-file-be w-100 m-1" style="display:none" >
                                        <label for="comp_otro_pn" id="lbl_comp_otro_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? ($insert_otr_ob[0] -> comp_otro === null ? "": "col-md-2 col-sm-3 col-xs-3") : "")); ?>" style="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? ($insert_otr_ob[0] -> comp_otro === null ? "display:none": "") : "")); ?>">

                                        <button data-ruta="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr > 0 ? $insert_otr_ob[0] -> comp_otro : "")); ?>" class="btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div>          
                                
                                <!-- Input que contiene el valor del id del certificado -->
                                <input type="hidden" name="val_cua_1" id="val_otro_1_pn" value="<?php echo ($cantidad_otr === 0 ? "0" : ($cantidad_otr > 0 ? $insert_otr_ob[0] -> id_estu_otro : "0")); ?>">
                            
                            </div>


                            <!-- SEGUNDA SECCION DE CURSOS, SEMINARIOS O DIPLOMADOS -->
                            <div class="cont-fre m-1 p-2" id="otro_2" style="<?php echo $cantidad_otr === 2 ? "display:block" : "display:none" ;?>">

                                <!-- Nombre del instituto certificador -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="nombre_instituto" id="nom_inst_otro_2_pn" placeholder="Nombre de instituto" class="form-control" value="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr === 2 ? $insert_otr_ob[1] -> nivel_ins_otro : "")); ?>">
                                    <label for="nom_inst_otro_2_pn">Nombre instituto</label>
                                </div>

                                <!-- Titulo que se certifica -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="titulo" id="tit_op_otro_2_pn" placeholder="Titulo obtenido" class="form-control" value="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr === 2 ? $insert_otr_ob[1] -> titulo_otro : "")); ?>">
                                    <label for="tit_op_otro_2_pn">Titulo obtenido</label>
                                </div>

                                <!-- Fecha de expedicion del certificado -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="tiempo_ingreso_2" id="tie_fin_otro_2_pn" class="form-control" value="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr === 2 ? $insert_otr_ob[1] -> fec_fin_otro : "")); ?>">
                                    <label for="tie_fin_otro_2_pn">Finalización</label> 
                                </div>

                                <!-- Certificado obtenido y boton de visualización -->
                                <div class=<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr === 2 ? ($insert_otr_ob[1] -> comp_otro === null ? "": "input-group") : "")); ?>>

                                    <!-- Carga de certificado -->
                                    <div class=<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr === 2 ? ($insert_otr_ob[1] -> comp_otro === null ? "col-md-12": "col-md-10 col-sm-9 col-xs-8") : "")); ?>>

                                        <input type="file" id="comp_otro_2_pn" name="comp_otro_2_pn" data-certificado="<?php echo ($cantidad_otr === 0 ? "no" : ($cantidad_otr === 2 ? $insert_otr_ob[1] -> comp_otro !== null ? "si" : "no" : "no")); ?>" class="custom-file-input w-100 m-1" style="display:none" >
                                        <label for="comp_otro_2_pn" id="lbl_comp_otro_2_pn" class="custom-file-label w-100">CARGAR CERTIFICADO</label>

                                    </div>

                                    <!-- Boton de visualizacion -->
                                    <div class="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr === 2 ? ($insert_otr_ob[1] -> comp_otro === null ? "col-md-2 col-sm-3 col-xs-3": "") : "")); ?>" style="<?php echo $cantidad_otr !== 2 ? "display:block" : "display:none" ;?>" >

                                        <button data-ruta="<?php echo ($cantidad_otr === 0 ? "" : ($cantidad_otr === 2 ? $insert_otr_ob[1] -> comp_otro : "")); ?>" class= "btn-file-beo m-0" type="button" >
                                            <img src="../../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                        </button>

                                    </div>
                                </div> 

                                <!-- Input que contiene el valor del id del certificado -->
                                <input type="hidden" name="val_cua_2" id="val_otro_2_pn" value="<?php echo ($cantidad_otr === 0 ? "0" : ($cantidad_otr === 2 ? $insert_otr_ob[1] -> id_estu_otro : "0")); ?>">
                            
                            </div>


                            <!-- BOTON PARA AGREGAR SEGUNDA SECCION DE CURSOS SEMINARIOS Y DIPLIMADOS -->
                            <div class="cont_add_btn" id="cont_add_btn_otro" style="<?php echo $cantidad_otr !== 2 ? "display:block" : "display:none" ;?>">
                                <button class="insertar_form" id="insert_otro_2">
                                    <img src="../../img/registro 1/icono de +.svg" alt="">
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section class="container">
                <div class="row g-2">

                    <!-- REFERENCIAS PERSONALES -->
                    <div class="col-md">
                        <div class="container cont-ifm m-1 p-2" id="expe_per">

                            <h3 class="pt-3">
                                REFERENCIAS PERSONALES
                            </h3>
                        
                            <!-- PRIMERA REFERENCIA PERSONAL -->
                            <div class="cont-fre m-1 p-2" id="ref_per_1">
                                
                                <!-- Nombres -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="nomb_ref" id="nomb_ref_pn" placeholder="Nombres" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per > 0 ? $insert_per_ob[0] -> nom_ref_per : "")); ?>">
                                    <label for="nomb_ref_pn">Nombres</label>
                                </div>

                                <!-- Apellidos -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="ape_ref" id="ape_ref_pn" placeholder="Apellidos" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per > 0 ? $insert_per_ob[0] -> ape_ref_per : "")); ?>">
                                    <label for="ape_ref_pn">Apellidos</label>
                                </div>

                                <!-- Cargo de la persona de referencia -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="car_ref" id="car_ref_pn" placeholder="Cargo" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per > 0 ? $insert_per_ob[0] -> cargo : "")); ?>">
                                    <label for="car_ref_pn">Cargo de referencia</label>
                                </div>

                                <!-- Telefono de la persona de referencia -->
                                <div class="form-floating">
                                    <input type="tel" name="cel_ref" id="cel_ref_pn" placeholder="Celular" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per > 0 ? $insert_per_ob[0] -> telefono_ref : "")); ?>">
                                    <label for="cel_ref_pn">Telefono celular</label>
                                </div>

                                <!-- Input que contiene el valor del id de referencia personal -->
                                <input type="hidden" name="val_ref_per_1" id="val_ref_per_1" value="<?php echo ($cantidad_per === 0 ? "0" : ($cantidad_per > 0 ? $insert_per_ob[0] -> id_ref_per : "0")); ?>">
                            
                            </div>

                            <!-- SEGUNDA REFERENCIA PERSONAL -->
                            <div class="cont-fre m-1 p-2" id="ref_per_2" style="<?php echo $cantidad_per === 2 ? "display:block" : "display:none" ;?>">
                                
                                <!-- Nombres -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="nomb_ref_2_pn" id="nomb_ref_2_pn" placeholder="Nombres" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per === 2 ? $insert_per_ob[1] -> nom_ref_per : "")); ?>">
                                    <label for="nomb_ref_2_pn">Nombres</label>
                                </div>

                                <!-- Apellidos -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="ape_ref_2_pn" id="ape_ref_2_pn" placeholder="Apellidos" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per === 2 ? $insert_per_ob[1] -> ape_ref_per : "")); ?>">
                                    <label for="ape_ref_2_pn">Apellidos</label>
                                </div>

                                <!-- Cargo de la persona de referencia -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="car_ref_2_pn" id="car_ref_2_pn" placeholder="Cargo" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per === 2 ? $insert_per_ob[1] -> cargo : "")); ?>">
                                    <label for="car_ref_2_pn">Cargo de referencia</label>
                                </div>

                                <!-- Telefono de la persona de referencia -->
                                <div class="form-floating">
                                    <input type="tel" name="cel_ref_2_pn" id="cel_ref_2_pn" placeholder="Celular" class="form-control" value="<?php echo ($cantidad_per === 0 ? "" : ($cantidad_per === 2 ? $insert_per_ob[1] -> telefono_ref : "")); ?>">
                                    <label for="cel_ref_2_pn">Telefono celular</label>
                                </div>

                                <!-- Input que contiene el valor del id de referencia personal -->
                                <input type="hidden" name="val_ref_per_2" id="val_ref_per_2" value="<?php echo ($cantidad_per === 0 ? "0" : ($cantidad_per === 2 ? $insert_per_ob[1] -> id_ref_per : "0")); ?>">
                            
                            </div>

                            <!-- BOTON PARA AGREGAR SEGUNDA REFERENCIA PERSONAL -->
                            <div class="cont_add_btn" style="<?php echo $cantidad_per !== 2 ? "display:block" : "display:none" ;?>">
                                <button class="insertar_form" id="insert_per_2">
                                    <img src="../../img/registro 1/icono de +.svg" alt="">
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="col-md">

                    </div>
                </div>
            </section>
        </form>
    </main>

    <!-- Redes -->
    <?php include_once ("../redes.php"); ?> 

    <div id="contMsgPN" class="contMsgPN">
        <div class="contMsgVEPN" id="contMsgVEPN">
            <div class="contMsgVEINPN" id="contMsgVEINPN">
                <div id="contMsgVINMPN" class="contMsgVEINMPN"></div>
                <button id="acVenEmVacMPN">ACEPTAR</button>
                <button id="acVenEmFallos">ACEPTAR</button>
            </div>    
        </div>
    </div>

    <div id="contCerrar" class="contCerrar">
        <div class="contCerrarSes" id="contCerrarSes">
            <div class="contCerrarCont" id="contCerrarCont">
                <div id="contCerrarIn" class="contCerrarIn"><h2>¿ESTA SEGURO DE QUERER SALIR?</h2></div>
                <div class="OnlyCont">
                    <button id="contCSi">SI</button>
                    <button id="contCNo">NO</button>
                </div>
            </div>    
        </div>
    </div>

    <div id="contHV" class="contHV">
        <div class="contVerHV" id="contVerHV">
            <div class="contIntHV" id="contIntHV">
                <div class="OnlyContHV">
                    <button class="btnCerHV" id="cerHV">X</button>
                </div>
                <div id="HVida" class="HVida"></div>
            </div>    
        </div>
    </div>

    <!-- Pie de pagina -->
    <footer class="footer">
        <section class="footer_pie">
            <div class="pie_copy">
                <p>© 2023 VIGIEMPLEO</p>
            </div>
            <div class="pie_redes">
                <p></p>
            </div>
            <div class="pie_contacto">
                <p>
                    <span>
                        <b>Número: </b> 305 400 9393<br>
                    </span>
                    <span>
                        <b>Correo: </b> vigiempleocom@gmail.com<br>
                    </span>
                    <span>
                        <b>Ubicación: </b> CRA 26 # 75 - 44
                    </span>
                </p>
            </div>
        </section>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            carga_ref_lab();
            carga_est();
            carga_cuali();
            carga_otro();
            carga_capa();
            carga_ref_per();
            updateLabel();
            $(document).ajaxStop(function() {
                updateBtn();
            });
			
			var valorBaseDatos = "<?php echo $estado ;?>";

            if (valorBaseDatos == "trabajando") {
                $('#estado').prop('checked',true);
                $('#estado_2').prop('checked',true);
                $('#estado_des').html("Trabajando");
                $('#estado_des_2').html("Trabajando");
            } else {
                $('#estado').prop('checked',false);
                $('#estado_2').prop('checked',false);
                $('#estado_des').html("Desempleado");
                $('#estado_des_2').html("Desempleado");
            }

            function carga_ref_lab() {
                const url_ob_ref_lab = "../../obtener_datos/natural/obtener_ref_lab.php";

                $.ajax({
                    url: url_ob_ref_lab,
                    type: 'GET',
                    success: function(respuesta) {
                        var datos = JSON.parse(respuesta);
                        var plantilla = '';
                        let x = 1;
                        datos.forEach(dato => {
                            plantilla += `
                            <div class=''>
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2">
                                                <table class="table mb-0">
                                                    ` + (x++) + `° REFERENCIA LABORAL
                                                </table>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nombre empresa:</th>
                                            <td>` + dato.nom_emp + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cargo:</th>
                                            <td>` + dato.cargo + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tiempo ingreso: </th>
                                            <td>` + dato.tie_ing + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tiempo salida: </th>
                                            <td>` + (dato.sig_trab === 'si' ? "Aun trabajando" : dato.tie_sal) + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jefe inmediato: </th>
                                            <td>` + dato.jef_inm + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Telefono: </th>
                                            <td>` + dato.tel_jef + `</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                <button class="btn-file-b w-100" data-ruta="` + dato.comp_lab + `">VER CERTIFICADO</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>`;
                        });
                        $('#expe_lab').html(plantilla);
                    }
                });
            }

            function carga_ref_per() {
                const url_ob_ref_per = "../../obtener_datos/natural/obtener_ref_per.php";

                $.ajax({
                    url: url_ob_ref_per,
                    type: 'GET',
                    success: function(respuesta) {
                        let datos = JSON.parse(respuesta);
                        let plantilla = '';
                        let x = 1;
                        datos.forEach(dato => {
                            plantilla += `
                            <div class=''> 
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2">
                                                <table class="table mb-0">
                                                    ` + (x++) + `° REFERENCIA PERSONAL
                                                </table>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nombre: </th>
                                            <td>` + dato.nom_ref + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Apellido: </th>
                                            <td>` + dato.ape_ref + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cargo: </th>
                                            <td>` + dato.cargo + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Celular: </th>
                                            <td>` + dato.tel_ref + `</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            `;
                        });
                        $('#expe_per').html(plantilla);
                    }
                });
            }

            function carga_otro() {
                const url_ob_otro = "../../obtener_datos/natural/obtener_otro.php";

                $.ajax({
                    url: url_ob_otro,
                    type: 'GET',
                    success: function(respuesta) {
                        let datos = JSON.parse(respuesta);
                        let plantilla = '';
                        let x = 1;
                        datos.forEach(dato => {
                            plantilla += `
                            <div class=''>
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2">
                                                <table class="table mb-0">
                                                    ` + (x++) + `° CURSO, SEMINARIO Y DIPLOMADO
                                                </table>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Lugar de estudio: </th>
                                            <td>` + dato.nom_ins + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Titulo: </th>
                                            <td>` + dato.titulo + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fecha fin: </th>
                                            <td>` + dato.fec_otro + `</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                <button class="btn-file-b w-100" data-ruta="`+ dato.comp_otro +`">VER CERTIFICADO</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>`;
                        });
                        $('#expe_otro').html(plantilla);
                    }
                });    
            }

            function carga_capa() {
                const url_ob_capa = "../../obtener_datos/natural/obtener_capa.php";

                $.ajax({
                    url: url_ob_capa,
                    type: 'GET',
                    success: function(respuesta) {
                        let datos = JSON.parse(respuesta);
                        let plantilla = '';
                        let x = 1;
                        datos.forEach(dato => {
                            plantilla += `
                            <div class=''>
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2">
                                                <table class="table mb-0">
                                                    ` + (x++) + `° CAPACITACIÓN
                                                </table>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Lugar de capacitación: </th>
                                            <td>` + dato.nom_ins + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cualificacion: </th>
                                            <td>` + dato.nom_cap + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fecha fin: </th>
                                            <td>` + dato.fec_cap + `</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                <button class="btn-file-b w-100" data-ruta="` + dato.doc_cap +`">VER CERTIFICADO</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>`;
                        });
                        $('#expe_capa').html(plantilla);
                    }
                });    
            } 

            function carga_cuali() {
                const url_ob_cuali = "../../obtener_datos/natural/obtener_cuali.php";

                $.ajax({
                    url: url_ob_cuali,
                    type: 'GET',
                    success: function(respuesta) {
                        let datos = JSON.parse(respuesta);
                        let plantilla = '';
                        let x = 1;
                        datos.forEach(dato => {
                            plantilla += `
                            <div class=''>
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2">
                                                <table class="table mb-0">
                                                    ` + (x++) + `° CUALIFICACIÓN
                                                </table>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Lugar de cualificacion: </th>
                                            <td>` + dato.lugar + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cualificacion: </th>
                                            <td>` + dato.nom_cua + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fecha fin: </th>
                                            <td>` + dato.fec_cua + `</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                <button class="btn-file-b w-100" data-ruta="` + dato.doc_cua +`">VER CERTIFICADO</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>`;
                        });
                        $('#cuali').html(plantilla);
                    }
                });    
            } 

            function carga_est() {
                const url_ob_est = "../../obtener_datos/natural/obtener_estudios.php";

                $.ajax({
                    url: url_ob_est,
                    type: 'GET',
                    success: function(respuesta) {
                        let datos = JSON.parse(respuesta);

                        console.log("carga del boton de estudios");
                        
                        let plantilla = '';
                        let x = 1;
                        datos.forEach(dato => {
                            
                            plantilla += `
                            <div class=''>
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2">
                                                <table class="table mb-0">
                                                    ` + (x++) + `° FORMACION ACADEMICA
                                                </table>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nombre: </th>
                                            <td>` + dato.nom_ins + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nivel academico: </th>
                                            <td>` + dato.niv_aca + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Titulo: </th>
                                            <td>` + dato.titulo + `</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fecha de fin: </th>
                                            <td>` + ((dato.sig_estu === 1 && dato.culmino === "no" ) ? "Aun estudiando" : dato.fec_fin) + `</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                <button class="btn-file-b w-100" data-ruta="` + dato.comp_est + `">VER CERTIFICADO</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>`;
                        });
                        $('#estu').html(plantilla);
                    }
                });
            }

            var selectedValue = $("#departamento_pn").val();

            $("#departamento_pn").ready(function () {

                $.ajax({
                    type: "POST",
                    url: "../../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);

                        var plantilla = '<option value="--">-</option>';
                        datos.forEach(dato => {
                            plantilla += "<option value=" + dato.cod_mun + ">" + dato.municipio + "</option>";
                        });

                        $('#municipio_pn').html(plantilla);

                        $('#municipio_pn').val('<?php echo $_SESSION["municipio"]; ?>');
                    },
                    error: function () {
                        console.error("Error al obtener municipios");
                    }
                });
            });

            $("#departamento_pn").change(function () {
                var selectedValue = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "../../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);
                        var plantilla = '<option value="--">Municipio</option>';
                        datos.forEach(dato => {
                            plantilla += "<option value=" + dato.cod_mun + ">" + dato.municipio + "</option>";
                        });
                        $('#municipio_pn').html(plantilla);
                    },
                    error: function () {
                        console.error("Error al obtener municipios");
                    }
                });
            });

            function updateLabel() {
                $('.custom-file-input').each(function() {
                    let certificado = $(this).data("certificado");
                    console.log("certificado: " + certificado);
                    

                    if (certificado === "no") {
                        $(this).next('.custom-file-label').text('CARGAR CERTIFICADO')
                            .css({
                                "background-color": "#dddbd5",
                                "border": "0.5px solid #424242",
                                "color": "#000"
                            });
                    } else {
                        $(this).next('.custom-file-label').text('CERTIFICADO CARGADO')
                            .css({
                                "background-color": "#2c3691",
                                "color": "#fff"
                            });
                    }
                });
            }

            function updateBtn() {

                $('.btn-file-b').each(function() {

                    let inputValue = $(this).data('ruta');

                    if (inputValue === null) {
                        $(this).text('SIN CERTIFICADO')
                            .css({"background-color": "#dddbd5","border": "0.5px solid #424242", "color": "#000","cursor":"default"})
                            .prop('disabled', true);
                    } else {
                        $(this).text('VER CERTIFICADO')
                            .css({"background-color": "#2c3691", "color": "#fff","cursor":"pointer"})
                            .prop('disabled', false);
                    }
                });
            }

            $(document).on('click', ".btn-file-b", function (e) {
                e.preventDefault();
                let ruta = $(this).data('ruta');
                console.log(ruta);

                $('#contHV').show();

                $('#HVida').empty();
                const pdfIframe = document.createElement('iframe');
                pdfIframe.src = "../" + ruta;
                pdfIframe.width = '100%';
                pdfIframe.height = '600px'; // Ajusta según sea necesario
                pdfIframe.style.border = 'none';    

                document.getElementById('HVida').appendChild(pdfIframe);

            });

            $(document).on('click', ".btn-file-beo", function (e) {
                e.preventDefault();
                let ruta = $(this).data('ruta');

                console.log(ruta);

                $('#contHV').show();

                $('#HVida').empty();

                const pdfIframe = document.createElement('iframe');
                pdfIframe.src = "../" + ruta;
                pdfIframe.width = '100%';
                pdfIframe.height = '600px'; // Ajusta según sea necesario
                pdfIframe.style.border = 'none';    

                document.getElementById('HVida').appendChild(pdfIframe);

            });

        });
    </script>
</body>
</html>