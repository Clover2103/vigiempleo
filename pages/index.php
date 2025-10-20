<?php

session_start();
include_once ("../conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto -> conexionBD();

$query = "SELECT id_empresa, logo_empresa FROM usuario_empresa ORDER BY id_increment DESC LIMIT 4";
$insert = $conexion->prepare($query);
$insert->execute();
$infemp = $insert->fetchAll(PDO::FETCH_OBJ);

if (isset($_SESSION["num_doc"])) {
    header("location: natural/inicio.php");
}

if (isset($_SESSION["id_empr"])) {
    header("location: empresa/inicio.php");
}

$query = "SELECT * FROM departamentos";
$insert = $conexion->prepare($query);
$insert->execute();
$insert_ob = $insert->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Somos una herramienta diseñada como solucion de talento humano para el sector de la vigilancia y seguridad privada.">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/redes.css">
    <link rel="shortcut icon" href="../img/Ojo vigiempleo cuadrado.ico">
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
                    <li class="decoracion_selec" ><a href="./index.php">Inicio</a></li>
                    <li><a href="./nosotros.php">Nosotros</a></li>
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

    <!-- Cuerpo y main -->
    <main class="cuerpo">
        <!-- Sección sliter inicial -->
        <section class="cuerpo_sliter">
            <div class="sliter_completo_izq">
                <div class="sliter_izq">
                    <img src="../img/inicio/Ojo vigiempleo.png" alt="vigiempleo">
                    <div class="sliter_p_button">
                        <p>
                            ¿Interesado en <b>empleo</b> o <b>personal</b> 
                            en el sector de vigilancia y Seguridad Privada?
                        </p>
                        <button id="btn_bus_ofer_sliter" class="btn_bus_ofer_sliter">
                            Buscar ofertas
                        </button>
                    </div>
                </div>
            </div>
            <div class="sliter_completo_der">
                <div class="sliter_der">
                    <img src="../img/inicio/personajes usuario no registrado INICIO.png" alt="personaje">
                </div>
            </div> 
        </section>

        <!-- Buscar ofertas -->
        <section class="cuerpo_oferta">
            <form id="formBus">
                <div class="oferta_conteiner">
                        <div class="oferta_bnt">
                            <h1>Busca la mejor oferta para tus capacidades laborales</h1>
                        </div>
                    <div class="oferta_cont_bus">
                        <div class="oferta_filtro">
                            <div class="oferta_cargo">
                                <img src="../img/inicio/icono maletin barra busqueda.svg" alt="cargo">
                                <select name="" id="cargo" class="form-control">
                                    <option disabled selected>Cargo</option>
                                    <option value="VIGILANTE DE SEGURIDAD">VIGILANTE DE SEGURIDAD</option>
                                    <option value="SUPERVISOR DE SEGURIDAD">SUPERVISOR DE SEGURIDAD</option>
                                    <option value="ESCOLTA">ESCOLTA</option>
                                    <option value="OPERADOR DE MEDIOS TECNOLOGICOS">OPERADOR DE MEDIOS TECNOLOGICOS</option>
                                </select>
                            </div>
							<div class="oferta_ciudad oferta_ciudad2">
                                <img src="../img/inicio/icono ubicacion barra busqueda.svg" alt="ubicacion">
                                <select class="form-control" id="departamento_bus" aria-label="departamento">
                                    <option disabled selected>Departamento</option>
                                    <?php
                                        foreach ($insert_ob as $departamento) {
                                            echo "<option value='" . $departamento ->  cod_dep .  "'>" . $departamento -> departamento . "</option>";
                                        }                                        
                                    ?>
                                </select>
                            </div>
                            <div class="oferta_ciudad">
                                <img src="../img/inicio/icono ubicacion barra busqueda.svg" alt="ubicacion">
                                <select class="form-control" id="municipios_bus" aria-label="municipio">
                                    <option disabled selected>Municipio</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Sección de empresas -->
        <section class="cuerpo_empresas">
            <div class="empresas_container">
                <div class="empresas_des">
                    <div>
                        <p>
                            Encuentra tu trabajo ideal con Vigiempleo.com 
                            empresas buscan personal con tu perfil profesional
                        </p>
                    </div>
                    <div class="btn_ver_mas_emp">
                        <a href="../pages/empresas.php" class="ov-btn-grow-skew">Ver más empresas</a>
                    </div>
                </div>
                <div class="empresas_empresas">
                    <?php
                        foreach ($infemp as $empresas) {     
                    ?>
                        <img src="<?php echo $empresas -> logo_empresa ?>" alt="">
                    <?php
                        }
                    ?>
                </div>
            </div>
        </section>

        <!-- Seccion final -->
        <section class="cuerpo_final">
            <div class="final_container">
                <div class="final_general">
                    <div>
                        <img src="../img/inicio/icono proyeccion laboralRecurso 1.svg" alt="primer beneficio">
                        <h3>Proyección laboral</h3>
                    </div>
                    <div>
                        <img src="../img/inicio/icono Visibilidad perfil etcRecurso 2.svg" alt="segundo beneficio">
                        <h3>Visibilidad del <br> perfil laboral de <br> candidatos</h3>
                    </div>
                    <div>
                        <img src="../img/inicio/icono acompanamiento procesos etcRecurso 3.svg" alt="tercero beneficio">
                        <h3>Acompañamiento en <br> procesos de selección</h3>
                    </div>
                </div>
                <div class="btn_ver_mas">
                    <a href="./nosotros.php#beneficios" class="ov-btn-grow-skew">Ver más</a>
                </div>
            </div>
        </section>

        <!-- Sección de buscar personal o empleo -->
        <section class="cuerpo_buscar">
            <div class="buscar_container">
                <div class="buscar_central">
                    <div>
                        <h2 class="buscar_titulo">
                            ¡Registrate ahora!
                        </h2>
                    </div>
                    <div class="buscar_btn">
                        <button class="bus_talento" id="btn_bus_talento">
                            BUSCA TALENTO <br> HUMANO
                        </button>
                        <button class="bus_empreo" id="btn_bus_empleo">
                            BUSCO EMPLEO
                        </button>
                    </div>
                    <div class="busca_mano">
                        <img src="../img/inicio/Mano.png" alt="mano buscadora">
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

    <div id="modal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close">X</button>
            <a id="modal-link" href="#" target="_blank" rel="noopener noreferrer">
                <img id="modal-image" class="modal-image" src="" alt="Imagen aleatoria">
                <button class="btn-dark">CONOCER MÁS</button>
            </a>
        </div>
    </div>

    <script>
        // Array de imágenes con links
        const imagesWithLinks = [
            { src: '../img/inicio/homeModal/imagen1.png', link: 'https://api.whatsapp.com/send?phone=573165294689' },
            { src: '../img/inicio/homeModal/imagen2.png', link: 'https://api.whatsapp.com/send?phone=573054009393' },
            { src: '../img/inicio/homeModal/imagen3.png', link: 'https://api.whatsapp.com/send?phone=573054009393' },
            { src: '../img/inicio/homeModal/imagen4.png', link: 'https://api.whatsapp.com/send?phone=573144422577' },
            { src: '../img/inicio/homeModal/imagen5.png', link: 'https://api.whatsapp.com/send?phone=573144422577' },
            { src: '../img/inicio/homeModal/imagen6.png', link: 'https://api.whatsapp.com/send?phone=573144422577' },
        ];

        window.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("modal");
            const modalImage = document.getElementById("modal-image");
            const modalLink = document.getElementById("modal-link");
            const closeBtn = modal.querySelector(".modal-close");

            // Revisa si ya se mostró
            if (!sessionStorage.getItem("modalShown")) {
                // Seleccionar imagen aleatoria
                const random = imagesWithLinks[Math.floor(Math.random() * imagesWithLinks.length)];
                modalImage.src = random.src;
                modalLink.href = random.link;

                // Mostrar modal
                modal.classList.remove("hidden");

                // Marcar como mostrado
                sessionStorage.setItem("modalShown", "true");
            }

            // Cerrar modal
            closeBtn.addEventListener("click", () => {
                modal.classList.add("hidden");
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="../js/main.js"></script>
	<script>
        $(document).ready(function () {
            $("#municipios_bus").prop("disabled", true);
            $("#departamento_bus").change(function () {
                var selectedValue = $(this).val();

                $("#municipios_bus").prop("disabled", false);
                $.ajax({
                    type: "POST",
                    url: "../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);
                        var plantilla = '<option disabled selected>Municipio</option>';
                        datos.forEach(dato => {
                            plantilla += "<option value=" + dato.cod_mun + ">" + dato.municipio + "</option>";
                        });
                        $('#municipios_bus').html(plantilla);
                    },
                    error: function () {
                        console.error("Error al obtener municipios");
                    }
                });
            });
        });
    </script>
</body>
</html>