<?php

session_start();
include_once ("../conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto -> conexionBD();

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
    <link rel="stylesheet" href="../css/contactenos.css">
    <link rel="stylesheet" href="../css/redes.css">
    <link rel="shortcut icon" href="http://localhost/Pagina/img/Ojo vigiempleo cuadrado.ico">
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
                <img src="../img/menu/logo vigiempleo.png" alt="logo">
            </div>
            <div class="menu_link">
                <ul class="menu_ul">
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./nosotros.php">Nosotros</a></li>
                    <li><a href="./noticias.php">Noticias</a></li>
                    <li class="decoracion_selec" ><a href="./contactenos.php">Contactenos</a></li>
                </ul>
            </div>
            <div class="menu_btn_cero">
                <button id="btn_registro" class="btn_menu_registro">
                    Registrarse
                </button>
                <button id="btn_login" class="btn_menu_login">
                    Iniciar sesión
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
                        <button id="btn_login_re" class="btn_menu_login">
                            Iniciar sesión
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
                            Comunicate con nosotros                          
                        </p>
                        <img src="../img/login/logo vigiempleo.png" alt="vigiempleo">
                    </div>
                </div>
            </div>
            <div class="sliter_completo_der">
                <div class="sliter_der">
                    <img src="../img/contactenos/Mano con celular.png" alt="personaje">
                </div>
            </div> 
        </section>

        <!-- Seccion form login -->
        <section class="form_login">
            <div class="login_container">
                <div class="login_cuerpo_izq">
                    <form id="form_cont">    
                        <h2>
                            Formulario de contacto
                        </h2>
                            <input type="text" name="nom_comp" id="nom_comp" placeholder="Nombre(s) y Apellido(s)">
                            <input type="email" name="correo" id="correo" placeholder="Correo">
                            <input type="number" name="telefono" id="telefono" placeholder="Celular">
                            <textarea name="descrip" id="descrip" cols="30" rows="10" placeholder="Escribe aqui el mensaje que enviaras"></textarea>
                        <button type="submit">
                            Enviar
                        </button>
                    </form>
                </div>
                <div class="login_cuerpo_der">
                    <img src="../img/contactenos/Personas hablandoo.png" alt="Persona login">
                </div>
            </div>
        </section>

        <section>
            <div class="seccion_4_container">
                <div class="beneficios_container">
                    <ul>
                        <li>
                            <div><img src="../img/contactenos/ICONO TELEFONO.svg" alt="check"></div>
                            <div><p>305 4009393</p></div>                               
                        </li>
                        <li>
                            <div><img src="../img/contactenos/ICONO MENSAJE.svg" alt="check"></div>
                            <div><p>vigiempleocom@gmail.com</p></div>
                        </li>
                        <li>
                            <div><img src="../img/contactenos/ICONO UBICACION.svg" alt="check"></div>
                            <div><p>CRA 26 # 75 - 44,Bogotá, Colombia</p></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </section>

        <!-- Redes -->
        <?php include_once ("./redes.php"); ?> 
    </main>

    <div id="contMsg" class="contMsg">
        <div class="contMsgCon" id="contMsgCon">
            <div class="contMsgConIn" id="contMsgConIn">
                <div id="contMsgConM" class="contMsgConM"></div>
                <button id="acVenEmConM">ACEPTAR</button>
                <button id="acVenEmConF">ACEPTAR</button>
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
                        <b>Ubicación: </b> CRA 26 # 75 - 44,Bogotá, Colombia
                    </span>
                </p>
            </div>
        </section>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>