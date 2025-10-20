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

$cont = [];

$id_emp = $_GET["id_emp"];
$_SESSION["id_emp"] = $id_emp;

$query = "SELECT * FROM usuario_empresa WHERE id_empresa = '$id_emp'";
$insert = $conexion -> prepare($query);
$insert -> execute();
$result = $insert->fetchAll(PDO::FETCH_OBJ);

$query ="SELECT v.id_empresa, v.id_vacante, v.nom_vacante, v.descripcion, v.salario, v.estado, mc.municipio, ue.id_empresa, ue.logo_empresa, ue.razon_social 
            FROM vacante v
            INNER JOIN usuario_empresa ue ON v.id_empresa = ue.id_empresa 
            INNER JOIN municipio mc ON v.municipio = mc.cod_mun 
            WHERE v.id_empresa = $id_emp AND estado = 1
            ORDER BY v.id_vacante DESC  LIMIT 10";

$insert = $conexion->prepare($query);
$insert->execute();
$infvac = $insert->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/perfil_empresa.css">
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
                    <div class="cont_ftn_btn">
                        <img src="<?php echo '../' . $_SESSION["fot_nat"]; ?>" alt="Foto de usuario">
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
                                    <g id="Capa_1-2" data-name="Capa 1">
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
                                    <img src="<?php echo '../' . $_SESSION["fot_nat"]; ?>" alt="Foto de usuario">
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

    <!-- Cuerpo y main -->
    <main class="cuerpo">
        <div class="cuerpo_emp_1" id="cuerpo_emp_1">
            <?php
                foreach($result as $empresa){
            ?>
                <section class="cuerpo_sliter">
                    <div class="sliter_completo_izq">
                        <div class="sliter_izq">
                            <h2>BIENVENIDO</h2>
                            <img src="../../img/inicio/Ojo vigiempleo.png" alt="vigiempleo">
                        </div>
                    </div>

                    <div class="sliter_completo_der_emp">
                        <div class="sliter_centro">
                            <h2 class="nom_empresa">
                                <?php
                                    echo $empresa -> razon_social;
                                ?>
                            </h2>
                            <img src="<?php echo '../' . $empresa -> logo_empresa; ?>" alt="logo_empresa">
                        </div>
                    </div> 
                </section>

                <section class="cuerpo_inf">
                    <div class="cuerpo_inf_quien">
                        <h2 class="quien_somos">
                            Acerca de <?php echo $empresa -> razon_social;?>
                        </h2>
                        <p class="descrip_empresa">
                            <?php
                                echo $empresa -> descripcion;
                            ?>
                        </p>
                    </div>
                    <div class="cuerpo_inf_img">
                        <div class="inf_img_cont">
                            <img src="<?php echo '../' . $empresa -> foto; ?>" alt="img_decoracion_1">
                        </div>
                    </div>
                </section>

                <section class="cuerpo_mis_vis">
                    <div class="mision">
                        <h2 class="quien_somos">
                            MISIÓN
                        </h2>
                        <p class="descrip_empresa">
                            <?php
                                echo $empresa -> mision;
                            ?>
                        </p>
                    </div>
                    <div class="vision">
                        <h2 class="quien_somos">
                            VISIÓN
                        </h2>
                        <p class="descrip_empresa">
                            <?php
                                echo $empresa -> vision;
                            ?>
                        </p>
                    </div>
                </section>
            <?php
                }
            ?>
        </div>

        <section class="resultado_bus" id="cont_vac_per">
            
            <?php
            foreach($infvac as $vacantes){
            ?>
            
                <div class="container_bus">
                    <div class="img_bus">
                        <img src="<?php echo '../' . $vacantes -> logo_empresa ?>" alt="logo_empresa">
                    </div>
                    <div class="nom_car_bus">
                        <p id="nom_empresa"><b><?php echo $vacantes -> razon_social ?></b></p>
                        <p id="cargo_empresa"><?php echo $vacantes -> nom_vacante ?></p>
                    </div>
                    <div>
                        <button id="btn_mas<?php echo $vacantes -> id_vacante ?>" class="btn_mas" value="<?php echo $vacantes -> id_vacante ?>">MOSTRAR MÁS</button>
                    </div>
                </div>

                <div class="container_des" id="container_des<?php echo $vacantes -> id_vacante?>">
                    <div class="cont_des_nom_car">
                        <p id="cargo_empresa"><b><?php echo $vacantes -> razon_social ?></b></p>
                        <img src="<?php echo '../' . $vacantes -> logo_empresa ?>" alt="logo_empresa">
                        <p id="ubicacion"><b><?php echo $vacantes -> municipio ?></b></p>
                    </div>
                    <div class="cont_des_des">
                        <p id="descripcion">
                            <?php echo $vacantes -> descripcion ?>
                        </p>
                    </div>
                    <div class="cont_des_conocer_mas">
                        <img src="<?php echo '../' . $vacantes -> logo_empresa ?>" alt="logo_empresa">
                        <button id="btn_postular<?php echo $vacantes -> id_vacante ;?>" class="btn_postular" value="<?php echo $vacantes -> id_vacante . "/" . $vacantes -> id_empresa;?>">
                            POSTULARME
                        </button>
                    </div>
                </div>
                <br>

            <?php
                }
            ?>
            
        </section>
        <section class="sec_btn">
            <button id="btn_ant_per" class="btn_mas">ANTERIOR</button>
            <button id="btn_sig_per" class="btn_mas">SIGUIENTE</button>
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

    <div id="contMsg" class="contMsg">
        <div class="contMsgVac" id="contMsgVac">
            <div class="contMsgVacIn" id="contMsgVacIn">
                <div id="contMsgVacM" class="contMsgVacM"></div>
                <button id="acVenEmVacM">ACEPTAR</button>
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