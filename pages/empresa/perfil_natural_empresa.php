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

$query_un = "SELECT * FROM usuario_natural WHERE numero_doc = '$usuario'";
$insert_un = $conexion->prepare($query_un);
$insert_un->execute();
$insert_ob_un = $insert_un->fetchAll(PDO::FETCH_OBJ);

$query_co = "SELECT * FROM cont_usuario WHERE numero_doc = '$usuario'";
$insert_co = $conexion->prepare($query_co);
$insert_co->execute();
$insert_ob_co = $insert_co->fetchAll(PDO::FETCH_OBJ);

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

$query_per = "SELECT * FROM ref_personal WHERE numero_doc = '$usuario'";
$insert_per = $conexion->prepare($query_per);
$insert_per->execute();
$cantidad_per = $insert_per->rowCount();

if ($cantidad_per > 0) {
    $insert_per_ob = $insert_per->fetchAll(PDO::FETCH_OBJ);
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/perfil_natural.css">
    <link rel="stylesheet" href="../../css/redes.css">
    <link rel="shortcut icon" href="../../img/Ojo vigiempleo cuadrado.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
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

    <!-- Cuerpo y main -->
    <main class="cuerpo cuerpo_1" id="cuerpo_1">
        <section class="cuerpo_sliter">
            <?php
                foreach($insert_ob_un as $inf_gen){
            ?>
            <div class="container_div">
                <div class="inf_usuario">
                    <div class="div_inf_foto">
                        <div class="cont_ftn_user">
                            <img src="<?php echo $inf_gen -> foto; ?>" alt="Foto de usuario">
                        </div>
                    </div>
                    <di class="inf_gen_usu">
                        <h2>
                            <?php
                                echo $inf_gen -> primer_nombre . " " .  $inf_gen -> segundo_nombre . "<br> " . $inf_gen -> primer_apellido . " " . $inf_gen -> segundo_apellido;
                            ?>
                        </h2>
                        <div class="cont_inf_usu">
                            <span class="span_1">
                                <p><?php echo "<b>". $inf_gen -> tipo_doc . "</b>" . ": " .  $inf_gen -> numero_doc . "<br>";?></p>
            <?php
                }
                foreach($insert_ob_co as $cont_us){
            ?>
                                <p><?php echo "<b>TEL: </b>" .  $cont_us -> telefono . "<br>"; ?></p>
                            </span>
                            <span class="span_2">
                                <p><?php echo "<b>DIR:  </b>" . $cont_us -> direccion . "<br>";?></p>
                                <p><?php echo "<b>EMAIL: </b>" .  $cont_us -> correo . "<br>"; ?></p>
                            </span>
                        </div>
                    </di>
                </div>
            </div>
            <?php
                }
            ?>
        </section>

        <section class="cuerpo_inf">
            <div class="seccion_prin">
                <div class="cuerpo_inf_izq_ne">
                    <div class="cont_sobre_mi_ne">
                        <h3>
                            SOBRE MI
                        </h3>
                        <?php
                            foreach($insert_ob_un as $inf_gen){
                        ?>
                        <div class="cont_des" id="cont_des">
                            <?php
                                echo "<br>" . $inf_gen -> descripcion . "<br><br>";
                            ?>
                        </div>
                    </div>
                        <?php
                            }
                        ?>
                    <div class="cont_exp_lab_ne">
                            <h3>
                                EXPERIENCIA LABORAL
                            </h3>
                        <div class="expe_lab" id="expe_lab">
                            <?php
                                if (isset($insert_lab_ob)) {
                                    foreach($insert_lab_ob as $lab_ob){
                            ?>
                                    <?php echo "<div class='cont_lab cont_p'>" ?>
                                        <?php echo "<p><b>Nombre empresa: </b>  <?php  ?>" . $lab_ob -> nom_empresa . "</p><p>";?>
                                        <?php echo "<p><b>Cargo: </b>  <?php  ?>" . $lab_ob -> cargo . "</p><p>";?>
                                        <?php echo "<p><b>Tiempo ingreso: </b>  <?php  ?>" . $lab_ob -> tie_ingreso . "</p><p>";?>
                                        <?php echo "<p><b>Tiempo salida: </b>  <?php  ?>" . $lab_ob -> tie_salida . "</p><p>";?>
                                        <?php echo "<p><b>Tiempo salida: </b>  <?php  ?>" . $lab_ob -> jefe_inmediato . "</p><p>";?>
                                        <?php echo "<p><b>Telefono: </b>  <?php  ?>" . $lab_ob -> tele_jefe . "</p><p>";?>
                                    <?php echo "</div>" ?>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <section class="secundaria">
            <div class="sec_cont">
                <div class="cont_sec_nat cont_secun">
                    <div class="cuerpo_estu_na">
                        <h3>
                            ESTUDIOS
                        </h3>
                        <div class="estu" id="estu">
                            <?php
                                if (isset($insert_est_ob)) {
                                    foreach($insert_est_ob as $est_ob){
                            ?>
                                    <?php echo "<div class='cont_estudios cont_p'>" ?>
                                        <?php echo "<p><b>Nombre: </b>  <?php  ?>" . $est_ob -> nom_insti . "</p><p>";?>
                                        <?php echo "<p><b>Nivel academico: </b>  <?php  ?>" . $est_ob -> nivel_aca . "</p><p>";?>
                                        <?php echo "<p><b>Nivel academico: </b>  <?php  ?>" . $est_ob -> titulo . "</p><p>";?>
                                        <?php echo "<p><b>Fecha de fin: </b>  <?php  ?>" . $est_ob -> fec_fin . "</p><p>";?>
                                    <?php echo "</div>" ?>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <div class="cont_cuali" id="cont_cuali">
                        <h3>
                            CAPACITACIONES
                        </h3>
                        <div class="cuali" id="cuali">
                            <?php
                                if (isset($insert_cap_ob)) {
                                    foreach($insert_cap_ob as $cap_ob){
                            ?>
                                        <?php echo "<div class='cont_cualifi cont_p'>" ?>
                                            <?php echo "<p><b>Lugar de capacitacion: </b>  <?php  ?>" . $cap_ob -> lugar . "</p><p>";?>
                                            <?php echo "<p><b>Capacitacion: </b>  <?php  ?>" . $cap_ob -> nom_cuapa . "</p><p>";?>
                                            <?php echo "<p><b>Fecha fin: </b>  <?php  ?>" . $cap_ob -> fec_cuapa . "</p><p>";?>
                                            <?php echo "<p><b>Comprobante capacitacion: </b>  <?php  ?>" . $cap_ob -> doc_cuapa . "</p><p>";?>
                                        <?php echo "</div>" ?>
                            <?php
                                    }
                                }
                            ?>
                        </div> 
                    </div>

                    <div class="cont_cuali" id="cont_cuali">
                        <h3>
                            CUALIFICACIONES
                        </h3>
                        <div class="cuali" id="cuali">
                            <?php
                                if (isset($insert_cua_ob)) {
                                    foreach($insert_cua_ob as $cua_ob){
                            ?>
                                <?php echo "<div class='cont_cualifi cont_p'>" ?>
                                    <?php echo "<p><b>Lugar de cualificacion: </b>  <?php  ?>" . $cua_ob -> lugar . "</p><p>";?>
                                    <?php echo "<p><b>Cualificacion: </b>  <?php  ?>" . $cua_ob -> nom_cualifi . "</p><p>";?>
                                    <?php echo "<p><b>Fecha fin: </b>  <?php  ?>" . $cua_ob -> fec_cualifi . "</p><p>";?>
                                    <?php echo "<p><b>Comprobante cualificación: </b>  <?php  ?>" . $cua_ob -> doc_cualifi . "</p><p>";?>
                                <?php echo "</div>" ?>
                            <?php
                                    }
                                }
                            ?>
                        </div> 
                    </div>

                    <div class="cont_cuali" id="cont_cuali">
                        <h3>
                            OTROS: CURSOS, SEMINARIOS Y DIPLOMADOS
                        </h3>
                        <div class="cuali" id="cuali">
                            <?php
                                if (isset($insert_otr_ob)) {
                                    foreach($insert_otr_ob as $otro_ob){
                            ?>
                                <?php echo "<div class='cont_cualifi cont_p'>" ?>
                                    <?php echo "<p><b>Nombre instituto: </b>  <?php  ?>" . $otro_ob -> nivel_ins_otro . "</p><p>";?>
                                    <?php echo "<p><b>Titulo: </b>  <?php  ?>" . $otro_ob -> titulo_otro . "</p><p>";?>
                                    <?php echo "<p><b>Fecha fin: </b>  <?php  ?>" . $otro_ob -> fec_fin_otro . "</p><p>";?>
                                    <?php echo "<p><b>Comprobante: </b>  <?php  ?>" . $otro_ob -> comp_otro . "</p><p>";?>
                                <?php echo "</div>" ?>
                            <?php
                                    }
                                }
                            ?>
                        </div> 
                    </div>
                    

                    <div>
                        <h3>
                            REFERENCIAS PERSONALES
                        </h3>
                        <div class="cont_ref_per" id="expe_per">
                            <?php
                                if (isset($insert_per_ob)) {
                                    foreach($insert_per_ob as $per_ob){
                            ?>
                                        <?php echo "<div class='cont_per cont_p'>" ?>    
                                            <?php echo "<p><b>Nombre: </b>  <?php  ?>" . $per_ob -> nom_ref_per . "</p><p>";?>
                                            <?php echo "<p><b>Apellido: </b>  <?php  ?>" . $per_ob -> ape_ref_per . "</p><p>";?>
                                            <?php echo "<p><b>Celular: </b>  <?php  ?>" . $per_ob -> telefono_ref . "</p><p>";?>
                                            <?php echo "<p><b>Cargo: </b>  <?php  ?>" . $per_ob -> cargo . "</p><p>";?>
                                        <?php echo "</div>" ?>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Redes -->
        <?php include_once ("../redes.php"); ?> 
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
</body>
</html>