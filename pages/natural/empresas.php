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

$query = "SELECT * FROM usuario_empresa ORDER BY id_empresa DESC";
$insert = $conexion->prepare($query);
$insert->execute();
$infemp = $insert->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/redes.css">
    <link rel="stylesheet" href="../../css/empresas.css">
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
                                    <img src="../<?php echo '../' . $_SESSION["fot_nat"]; ?>" alt="Foto de usuario">
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
        <!-- Sección sliter inicial -->
        <section class="cuerpo_sliter">
            <div class="sliter_completo_izq">
                <div class="sliter_izq">
                    <img src="../../img/inicio/Ojo vigiempleo.png" alt="vigiempleo">
                    <div class="sliter_p_button">
                        <p>
                            ¿Interesado en <b>empleo</b> en el sector de 
                            vigilancia y Seguridad Privada?
                        </p>
                        <button id="btn_bus_ofer_sliter_natural" class="btn_bus_ofer_sliter">
                            Buscar ofertas
                        </button>
                    </div>
                </div>
            </div>
            <div class="sliter_completo_der">
                <div class="sliter_der">
                    <img src="../../img/inicio/Vigilante hombre registrado.png" alt="personaje">
                </div>
            </div> 
        </section>

        <!-- Sección de empresas -->
        <section class="cuerpo_empresas">
            <?php
                foreach($infemp as $empresa){
            ?>
                <div class="container_bus">
                    <div class="img_bus">
                        <img src="<?php echo '../' . $empresa -> logo_empresa ?>" alt="logo_empresa">
                    </div>
                    <div class="nom_car_bus">
                        <h2 id="nom_empresa"><b><?php echo $empresa -> razon_social ?></b></h2><br>
                        <p id="descrip_emp"><b><?php echo $empresa -> descripcion ?></b></p>
                    </div>
                    <div class="cont_btn">
                        <button id="inf_empresa" class="inf_empresa" value="<?php echo $empresa -> id_empresa ?>">
                            ¡SABER MÁS! 
                        </button>
                    </div>
                </div>
            <?php
                }
            ?>           
        </section>
        <!-- <section class="sec_btn">
            <button id="btn_ant" class="btn_mas">ANTERIOR</button>
            <button id="btn_sig" class="btn_mas">SIGUIENTE</button>
        </section> -->


        <!-- Redes -->
        <?php include_once ("../redes.php"); ?> 
    </main>
    

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