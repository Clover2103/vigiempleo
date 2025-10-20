<?php

session_start();

if (isset($_SESSION["num_doc"])) {
    header("location: natural/inicio.php");
}

if (isset($_SESSION["id_empr"])) {
    header("location: empresa/inicio.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/redes.css">
    <link rel="shortcut icon" href="http://localhost/Pagina/img/Ojo vigiempleo cuadrado.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Vigiempleo - Nosotros</title>
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
                <img src="../img/menu/logo vigiempleo.png" alt="logo">
            </div>
            <div class="menu_link">
                <ul class="menu_ul">
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./nosotros.php">Nosotros</a></li>
                    <li><a href="./noticias.php">Noticias</a></li>
                    <li><a href="./contactenos.php">Contactenos</a></li>
                </ul>
            </div>
            <div class="menu_btn_cero">
                <button id="btn_registro" class="btn_menu_registro">
                    Registrarse
                </button>
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
                    <img src="../img/menu/logo vigiempleo.png" alt="logo">
                </li>
                <li><a href="./index.php">Inicio</a></li>
                <li><a href="./nosotros.php">Nosotros</a></li>
                <li><a href="./noticias.php">Noticias</a></li>
                <li><a href="./contactenos.php">Contactenos</a></li>
                <li>
                    <div class="button_responsive">
                        <button id="btn_registro_re" class="btn_menu_registro">
                            Registrarse
                        </button>
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
                    <div class="sliter_p_button">
                        <p>
                            Bienvenido a nuestra plataforma                           
                        </p>
                        <img src="../img/login/logo vigiempleo.png" alt="vigiempleo">
                    </div>
                </div>
            </div>
            <div class="sliter_completo_der">
                <div class="sliter_der">
                    <img src="../img/inicio/personajes usuario no registrado INICIO.png" alt="personaje">
                </div>
            </div> 
        </section>

        <!-- Seccion form login -->
        <section class="form_login">
            <div class="login_container">
                <div class="login_cuerpo_izq">
                    <form id="form_login">
                        <h2>
                            INICIO DE SESIÓN
                        </h2>
                            <input type="text" name="" id="id_user" class="input input_form" placeholder="Identificador de usuario"> <br>
							<div class="contrasena">
                                <input type="password" name="contrasena" id="cont_user" class="con_pass" placeholder="Contraseña">
                                <button id="btn_ver_log">
                                    <img src="../img/registro 1/ojo_abierto.svg" alt="">
                                </button>
                            </div><br>
                            <div class="cont_check">
                                <div>
                                    <label for="rad_us_nat">Natural</label>
                                    <input type="radio" name="tip_usuario" id="rad_us_nat" value="natural" checked>
                                </div>
                                <div>
                                    <label for="rad_us_emp">Empresa</label>
                                    <input type="radio" name="tip_usuario" id="rad_us_emp" value="empresa">
                                </div>
                            </div>
                            <label for="inp_rec_cred">Recuerda mis credenciales</label>
                            <input type="checkbox" name="recordar" id="inp_rec_cred" value="recordarme" class="input_check input_form"> <br>
                        <button type="submit";>
                            Ingresar
                        </button>    
                    </form>
                </div>
                <div class="login_cuerpo_der">
                    <img src="../img/login/persona login.png" alt="Persona login">
                </div>
            </div>
        </section>

        <!-- Redes -->
        <?php include_once ("./redes.php"); ?> 
    </main>

    <div id="contVeEmLo" class="contVeEmLo">
        <div class="wind_msg_EmLo" id="wind_msg_EmLo">
            <div class="contWinMsg_EmLo" id="contWinMsg_EmLo">
                <div id="cont_msg_VeEmLo" class="cont_msg_VeEmLo"></div>
                <button id="acVenEmLo">ACEPTAR</button>
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
    <script src="../js/main.js"></script>
</body>
</html>