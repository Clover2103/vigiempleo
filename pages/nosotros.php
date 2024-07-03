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
    <link rel="stylesheet" href="../css/nosotros.css">
    <link rel="stylesheet" href="../css/redes.css">
    <link rel="shortcut icon" href="../img/Ojo vigiempleo cuadrado.ico">
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
                    <li class="decoracion_selec" ><a href="./nosotros.php">Nosotros</a></li>
                    <li><a href="./noticias.php">Noticias</a></li>
                    <li><a href="./contactenos.php">Contactenos</a></li>
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

    <!-- Cuerpo -->
    <main class="cuerpo">

        <!-- Quienes somos -->
        <section class="cuerpo__seccion_1">
            <div class="seccion_1_izq">
                <div>
                    <h2>
                        ¿QUE ES VIGIEMPLEO.COM?
                    </h2>
                    <p>
                        Somos una herramienta diseñoada como solución de talento
                        humano para el sector de la vigilancia y seguridad privada. 
                        Esta novedosa plataforma tecnologia ayuda a las personas 
                        a encontrar un trabajo y a crecer profesionalmente y a las 
                        empresas a encontrar el profesional que mejor encaje con sus
                        necesidades, facilitar y agilizar los procesos de sección.
                    </p>
                </div>
            </div>
            <div class="seccion_1_der">
                <div class="seccion_1_der_containter">
                    <img src="../img/inicio/vigiempleo cuadrado.png" alt="logo">
                </div>
                
            </div>
        </section>

        <!-- Proyeccion laboral -->
        <section class="cuerpo__seccion_2">
            <div class="seccion_2_izq">
                    <div class="seccion_2_izq_container">
                        <img src="../img/nosotros/7.png" alt="Persona">
                    </div>
            </div>
            <div class="seccion_2_der">
                <h2>
                    ¡PROYECCIÓN LABORAL!
                </h2>
                <p>
                    Para nuestras empresas cliente facilitamos la comunicación 
                    entre el talento humano por medio de amplios canales  
                    de mercadeo para movilizazr requerimientos de afilaidos.
                </p>
                <button id="btn_registrarse" class="btn_registrarse">
                    Regístrate ahora
                </button>
            </div>
        </section>

        <!-- Misión y Visión -->
        <section class="cuerpo__seccion_3">
            <div class="cuerpo_mision">
                <h3>
                    MISIÓN
                </h3>
                <p>
                    Permitir la forma oportuna y eficiente la solución de las necesidades 
                    laborales del talento humano tanto empresariales como personales.
                </p>
            </div>
            <div class="cuerpo_vision">
                <h3>
                    VISIÓN
                </h3>
                <p>
                    Para el 2025 ser la plataforma tecnológica más dinamica
                    y reconocida en la solución de recursos del talento humano
                </p>
            </div>
        </section>

        <!-- Beneficios -->
        <section class="cuerpo__seccion_4" id="beneficios">
            <h3>
                NUESTROS BENEFICIOS
            </h3>
            <div class="beneficios_cuerpo">
                <div class="seccion_4_container">
                    <div class="beneficios_container">
                        <img src="../img/nosotros/icono empresa.svg" alt="beneficios empresas">
                        <div>
                            <h3>
                                Empresas
                            </h3>
                            <p>
                                Ofrecemos a las empresas acompañamiento directo en
                                el proceso de reclutamiento en el área de gestión 
                                humana.
                            </p>
                        </div>
                        <ul>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Acompañamiento en procesos de selección</div>
                            </li>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Revisión de los datos suministrados.</div>                                
                            </li>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Descuentos especiales con nuestros alidados.</div>
                            </li>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Pre-selección de los perfiles.</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="seccion_4_container">
                    <div class="beneficios_container">
                        <img src="../img/nosotros/nosotros candidatos.svg" alt="beneficios candidatos">
                        <div>
                            <h3>
                                Candidatos
                            </h3>
                            <p>
                                Ofrecemos a los candidatos acompañamiento directo en el
                                proceso de búsqueda de ofertas laborales
                            </p>
                        </div>
                        <ul>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Orientación en la presentación de la hoja de vida.</div>                               
                            </li>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Descuentos con nuestros aliados en la capacitación y 
                                    certificación en competencias</div>
                            </li>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Revisión y corrección y certificación en competencias laborales.</div>
                            </li>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Visibilidad del perfil laboral ante las diferentes empresas con la 
                                    posibilidad de agendar entrevistas sin intermediarios.</div>
                            </li>
                            <li>
                                <div><img src="../img/nosotros/check.svg" alt="check"></div>
                                <div>Financiación a la medida para su mejora continua.</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Aliados -->
        <section class="cuerpo__seccion_5">
            <div class="cuerpo_aliados">
                <h3>NUESTROS ALIADOS</h3>
                <div class="aliados_logos">
                    <div class="aliado cogno">
                        <figure>
                            <img src="../img/nosotros/aliados/cognoseguridad.png" alt="cogno">
                            <div class="cogno_inf aliado_inf">
                                <p>
                                    Somos una academia de capacitación constituida en el año 2000 que tiene por 
                                    objeto social proveer enseñanza, capacitación, entrenamiento y actualización 
                                    de conocimiento relacionados con Vígilancia y Seguridad Privada en sus 
                                    diferentes áreas.
                                </p>
                                <button id="btn_cogno">
                                    Conoce más
                                </button>
                            </div>
                        </figure>                        
                    </div>
                    <div class="aliado conasegur">
                        <figure>
                            <img src="../img/nosotros/aliados/conasegur.png" alt="conasegur">
                            <div class="conasegur_inf aliado_inf">
                                <p>
                                    Somo la Corporación Nacional de Empresas de Seguridad privada
                                    "CONASEGUR", gremio del sector de la Vigilancia y Seguridad 
                                    privada, con cubrimiento de nivel Nacional.
                                </p>
                                <button id="btn_conasegur">
                                    Conoce más
                                </button>
                            </div>
                        </figure>
                    </div>
                    <div class="aliado club">
                        <figure>
                            <img src="../img/nosotros/aliados/club.png" alt="club">
                            <div class="club_inf aliado_inf" >
                                <p>
                                    Fomenta el respeto, la sana convivencia, el juego limpio y el 
                                    espíritu de copetencia para el personal de Seguridad Privada.
                                </p>
                                <button id="btn_club">
                                    Conoce más
                                </button>
                            </div>
                        </figure>
                    </div>
                    <div class="aliado ocp">
                        <figure>
                            <img src="../img/nosotros/aliados/ocp.png" alt="ocp">
                            <div class="ocp_inf aliado_inf">
                                <p>
                                    Con un alto sentido de Responsabilidad Social Empresarial, busca ser su
                                    ALIADO ESTRATÉGICO frente a la determinación de las perspectivas 
                                    estratégicas en el recurso humano que necesita su empresa.
                                </p>
                                <button id="btn_ocp">
                                    <a >Conoce más</a>
                                </button>
                            </div>
                        </figure>
                    </div>
                    <div class="aliado sst">
                        <figure>
                            <img src="../img/nosotros/aliados/sst.png" alt="sst">
                            <div class="sst_inf aliado_inf">
                                <p>
                                    Contamos con la licencia para la prestación de los servicios de 
                                    seguridad y salud en el trabajo, concedida por el Ministerio de Salud 
                                    y prevención desde el año 2012 con vigencia de 10 años.
                                </p>
                                <button id="btn_sst">
                                    Conoce más
                                </button>
                            </div>
                        </figure>
                    </div>
                    <div class="aliado vial">
                        <figure>
                            <img src="../img/nosotros/aliados/vialseguridad.png" alt="vialseguridad">
                            <div class="vial_inf aliado_inf">
                                <p>
                                    Somos una empresa especializada en Capacitación, con un alto sentido de 
                                    Responsavilidad Social Empresarial, que busca ser su ALIADO ESTRATEGICO 
                                    frente a la determinación de las perspectivas estratégicas en el recurso 
                                    humano.
                                </p>
                                <button id="btn_vial">
                                    Conoce más
                                </button>
                            </div>
                        </figure>
                    </div>
                    <div class="aliado funhumac">
                        <figure>
                            <img src="../img/nosotros/aliados/funhumac.png" alt="funhumac">
                            <div class="funhumac_inf aliado_inf">
                                <p>
                                    La Fundación Humana - Mujer Activa, es una organización que fomenta, 
                                    fortalece y facilita el mejoramiento de la calidad de vida de las personas, 
                                    las familias y la sociedad, con especial atención a aquellas que se encuentran 
                                    en condición de vulnerabilidad;
                                </p>
                                <button id="btn_funhumac">
                                    Conoce más
                                </button>
                            </div>
                        </figure>
                    </div>
                    <div class="aliado acimad_c">
                        <figure>
                            <img src="../img/nosotros/aliados/acimad consultoria.png" alt="acimad_c">
                            <div class="acimad_c_inf aliado_inf">
                                <p>
                                    Entidad de consultoria, asesoria e investigación y auditoria de las 
                                    perspectivas fundamentales en el directriz de seguridad y administración 
                                    de riesgos de un alto sentido de responsabilidad.
                                </p>
                                <button id="btn_acimad_c">
                                    Conoce más
                                </button>
                            </div>
                        </figure>
                    </div>
                    <div class="aliado acimad_s">
                        <figure>
                            <img src="../img/nosotros/aliados/acimad seguridad.png" alt="acimad_s">
                            <div class="acimad_s_inf aliado_inf">
                                <p>
                                    Somo una empresa de Seguridad Privada que cuenta con autorización 
                                    SuperVigilancia Res. 20224100050807 de 05-08-2022, con un alto 
                                    sentido de Responsabilidad Social Empresarial, que busca ser su 
                                    ALIADO ESTRTEGICO.
                                </p>
                                <button id="btn_acimad_s">
                                    Conoce más
                                </button>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <!-- Redes -->
        <?php include_once ("./redes.php"); ?> 
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
    <script src="../js/main.js"></script>
    </body>
</html>