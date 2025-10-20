<?php

session_start();
if (!isset($_SESSION["id_empr"])) {
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

$usuario = $_GET["num_doc"];

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

$query = "SELECT * FROM usuario_natural WHERE numero_doc = '$usuario'";
$insert = $conexion->prepare($query);
$insert->execute();
$usuario_inf = $insert->fetch(PDO::FETCH_OBJ);

$query = "SELECT * FROM cont_usuario WHERE numero_doc = '$usuario'";
$insert = $conexion->prepare($query);
$insert->execute();
$cont_usuario = $insert->fetch(PDO::FETCH_OBJ);

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
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="shortcut icon" href="../../img/Ojo vigiempleo cuadrado.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/redes.css">
    <link rel="stylesheet" href="../../css/perfil_natural.css">
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
                    <div class="cont_ftn_btn_emp">
                        <img src="<?php echo '../' . $_SESSION["log_emp"]; ?>" alt="Foto de usuario">
                    </div>
                    <button id="dropdown-button" class="per_nat">
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
                <ul id="dropdown-menu">
                    <li><a id="btnPerfil"><b>VER PERFIL</b></a></li>
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
                                <div class="cont_ftn_btn_emp">
                                    <img src="<?php echo '../' . $_SESSION["log_emp"]; ?>" alt="Foto de usuario">
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
                                <li><a id="btnPerfil2"><b>VER PERFIL</b></a></li>
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
                                <img src="<?php echo "../" . $usuario_inf -> foto; ?>" alt="Foto de usuario">
                            </div>
                        </div>

                    </div>

                    <!-- Informacion general de contacto -->
                    <diV class="container txt-c">

                        <!-- Nombre completo -->
                        <h2 class="mt-4 mb-5">
                            <?php
                                echo $usuario_inf -> primer_nombre . " " . $usuario_inf -> segundo_nombre . " " . $usuario_inf -> primer_apellido . " " . $usuario_inf -> segundo_apellido;
                            ?>
                        </h2>

                        <div class="row g-3">

                            <div class="col-md">
                                <p><?php echo "<b>". $usuario_inf -> tipo_doc . "</b>" . ": " .  $usuario_inf -> numero_doc;?></p>
                            </div>

                            <div class="col-md">
                                <p><?php echo "<b>CORREO: <br></b>" .  $cont_usuario -> correo; ?></p>
                            </div>

                            <div class="col-md">
                                <p><?php echo "<b>CELULAR: <br></b>" .  $cont_usuario -> telefono ; ?></p>
                            </div>

                        </div>

                        <div class="row g-3">

                            <div class="col-md">
                                <p>
                                    <?php
                                        foreach ($insert_dp as $departamento) {
                                            if ($cont_usuario->departamento == $departamento->cod_dep) {
                                                echo "<b>DEPARTAMENTO: <br></b>" . $departamento->departamento;
                                                break; // Salir del bucle después de encontrar el departamento correspondiente
                                            }
                                        }
                                    ?>
                                </p>
                            </div>

                            <div class="col-md">
                                <p>
                                    <?php
                                        foreach ($insert_mc as $municipio) {
                                            if ($cont_usuario->municipio == $municipio->cod_mun) {
                                                echo "<b>MUNICIPIO: <br></b>" . $municipio->municipio;
                                                break; // Salir del bucle después de encontrar el municipio correspondiente
                                            }
                                        }
                                    ?>
                                </p>
                            </div>

                            <div class="col-md">
                                <p><?php echo "<b>DIRECCIÓN:  <br></b>" . $cont_usuario -> direccion ;?></p>
                            </div>

                        </div>

                    </diV>
                </div>
                <div class="cuerpo_sliter_btn">
                    <button id="btn_hv_vigi">
                        Ver Hoja de Vida
                    </button>
                </div>
            </div>
        </section>

        <section class="container mt-4">
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
                                        echo "<br>" . $usuario_inf -> descripcion . "<br><br>";
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">


                    <div class="container cont-ifm m-1 p-2">

                        <h3 class="pt-3">
                            EXPERIENCIA LABORAL
                        </h3>

                        <div class="expe_lab" id="expe_lab_emp">
                            
                        </div>

                    </div>
                </div>
				
                <div class="col-md">
                    <div class="container cont-ifm m-1 p-2">

                        <h3>
                            ESTUDIOS
                        </h3>

                        <div class="estu" id="estu_emp">

                        </div>

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
                                    CAPACITACIONES                        
                                </h3>
    
                                <div class="cont_ref_per" id="expe_capa_emp">
                                    
                                </div>
    
                            </div>

                        </div>

                        <div class="col-md">

                            <div class="container cont-ifm m-1 p-2" id="cont_cuali_emp">
        
                                <h3>
                                    CUALIFICACIONES
                                </h3>
        
                                <div class="cuali" id="cuali_emp">
                                    
                                </div> 
        
                            </div>

                        </div>
                    
                    </div>


                    <div class="row g-2">

                        <div class="col-md">

                            <div class="container cont-ifm m-1 p-2">
    
                                <h3>
                                    OTROS: CURSOS, SEMINARIOS Y DIPLOMADOS
                                </h3>
    
                                <div class="cont_ref_per" id="expe_otro_emp">
                                    
                                </div>
    
                            </div>

                        </div>

                        <div class="col-md">

                            <div class="container cont-ifm m-1 p-2">
        
                                <h3>
                                    REFERENCIAS PERSONALES
                                </h3>
        
                                <div class="cont_ref_per" id="expe_per_emp">
                                    
                                </div>
        
                            </div>

                        </div>
                    
                    </div>

                    
                </div>
            </div>
        </section>
    </main>
















    

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

            function carga_ref_lab() {
                const usuario = "<?php echo $usuario; ?>";
                const url_ob_ref_lab = "../../obtener_datos/natural/obtener_ref_lab.php?usuario=" + usuario;;

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
                        $('#expe_lab_emp').html(plantilla);
                    }
                });
            }

            function carga_ref_per() {
                const usuario = "<?php echo $usuario; ?>";
                const url_ob_ref_per = "../../obtener_datos/natural/obtener_ref_per.php?usuario=" + usuario;

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
                        $('#expe_per_emp').html(plantilla);
                    }
                });
            }

            function carga_otro() {
                const usuario = "<?php echo $usuario; ?>";
                const url_ob_otro = "../../obtener_datos/natural/obtener_otro.php?usuario=" + usuario;

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
                        $('#expe_otro_emp').html(plantilla);
                    }
                });    
            }

            function carga_capa() {
                const usuario = "<?php echo $usuario; ?>";
                const url_ob_capa = "../../obtener_datos/natural/obtener_capa.php?usuario=" + usuario;

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
                        $('#expe_capa_emp').html(plantilla);
                    }
                });    
            } 

            function carga_cuali() {
                const usuario = "<?php echo $usuario; ?>";
                const url_ob_cuali = "../../obtener_datos/natural/obtener_cuali.php?usuario=" + usuario;;

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
                        $('#cuali_emp').html(plantilla);
                    }
                });    
            } 

            function carga_est() {
                const usuario = "<?php echo $usuario; ?>";
                console.log(usuario);
                
                const url_ob_est = "../../obtener_datos/natural/obtener_estudios.php?usuario=" + usuario;;

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
                        $('#estu_emp').html(plantilla);
                    }
                });
            }

            function updateLabel() {
                $('.custom-file-input').each(function() {

                    let inputValue = $(this).prop("name");

                    if (inputValue == "") {
                        $(this).next('.custom-file-label').text('CARGAR CERTIFICADO').css({"background-color": "#dddbd5","border": "0.5px solid: #424242",  "color": "#000"});    
                    } else {
                        $(this).next('.custom-file-label').text('CERTIFICADO CARGADO').css({"background-color": "#2c3691", "color": "#fff"});    
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