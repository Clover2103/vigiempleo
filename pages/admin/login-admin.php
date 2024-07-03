<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/login-admin.css">
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
                <img src="../../img/menu/logo vigiempleo.png" alt="logo">
            </div>
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
                            Bienvenido administrador                           
                        </p>
                        <img src="../../img/login/Ojo vigiempleo.png" alt="vigiempleo">
                    </div>
                </div>
            </div>
            <div class="sliter_completo_der">
                <div class="sliter_der">
                    <img src="../../img/inicio/personajes usuario no registrado INICIO.png" alt="personaje">
                </div>
            </div> 
        </section>

        <!-- Seccion form login -->
        <section class="form_login">
            <div class="login_container">
                <div class="login_cuerpo_izq">
                    <form id="form_login_admin">
                        <h2>
                            INICIO DE SESIÓN ADMIN
                        </h2>
                            <input type="text" name="" id="id_user" class="input input_form" placeholder="Usuario"> <br>
							<div class="contrasena">
                                <input type="password" name="contrasena" id="cont_user" class="con_pass" placeholder="Contraseña">
                                <button id="btn_ver_log">
                                    <img src="../../img/registro 1/ojo_abierto.jpg" alt="">
                                </button>
                            </div><br>
                            <label for="inp_rec_cred">Recuerda mis credenciales</label>
                            <input type="checkbox" name="recordar" id="inp_rec_cred" value="recordarme" class="input_check input_form"> <br>
                        <button type="submit";>
                            Ingresar
                        </button>    
                    </form>
                </div>
            </div>
        </section>
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
    <script src="../../js/main.js"></script>
</body>
</html>