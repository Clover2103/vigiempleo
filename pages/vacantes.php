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

$query_emp="SELECT id_empresa, razon_social FROM usuario_empresa";            
$insert_emp = $conexion->prepare($query_emp);
$insert_emp->execute();
$infemp = $insert_emp->fetchAll(PDO::FETCH_OBJ);

$query_dep = "SELECT * FROM departamentos";
$insert_dep = $conexion->prepare($query_dep);
$insert_dep->execute();
$insert_ob_dep = $insert_dep->fetchAll(PDO::FETCH_OBJ);

$query_mun = "SELECT * FROM municipio";
$insert_mun = $conexion->prepare($query_mun);
$insert_mun->execute();
$insert_ob_mun = $insert_mun->fetchAll(PDO::FETCH_OBJ);

$cargo          = "";
$departamento   = "";
$municipio      = "";

if ($_GET['cargo'] !== "null") {
    $cargo = $_GET['cargo'];
}

if ($_GET['departamento'] !== "null") {
    $departamento  = $_GET['departamento'];
    if ($_GET['departamento'] !== "null" && $_GET['municipio'] !== "null") {
        $municipio  = $_GET['municipio'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/redes.css">
    <link rel="stylesheet" href="../css/vacantes.css">
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
        <!-- Buscar ofertas -->
        <section class="cuerpo_oferta">
            <div class="oferta_conteiner">
                    <div class="oferta_bnt">
                        <h1>Busca la mejor oferta para tus capacidades laborales</h1>
                    </div>
                <div class="oferta_cont_bus">
                    <form action="" id="form_cons_vac" class="oferta_cont_bus">       
                        <div class="oferta_filtro"> 
                            <div class="oferta_cargo">
                                <img src="../img/inicio/icono maletin barra busqueda.svg" alt="cargo">
                                <select name="" id="vac_cargo" class="form-control">
                                    <option value="" disabled selected>Cargo</option>
                                    <option value="VIGILANTE DE SEGURIDAD" <?php if ($cargo == "VIGILANTE DE SEGURIDAD") { echo "selected"; } ?>>VIGILANTE DE SEGURIDAD</option>
                                    <option value="SUPERVISOR DE SEGURIDAD" <?php if ($cargo == "SUPERVISOR DE SEGURIDAD") { echo "selected"; } ?>>SUPERVISOR DE SEGURIDAD</option>
                                    <option value="ESCOLTA" <?php if ($cargo == "ESCOLTA") { echo "selected"; } ?>>ESCOLTA</option>
                                    <option value="OPERADOR DE MEDIOS TECNOLÓGICOS" <?php if ($cargo == "OPERADOR DE MEDIOS TECNOLÓGICOS") { echo "selected"; } ?>>OPERADOR DE MEDIOS TECNOLÓGICOS</option>
                                </select>
                            </div>
                            <div class="oferta_ciudad">
                                <img src="../img/inicio/icono ubicacion barra busqueda.svg" alt="ubicacion">
                                <select class="form-control" id="departamento" aria-label="departamento">
                                    <option disabled selected>Departamento</option>
                                    <?php
                                        foreach ($insert_ob_dep as $departamentos) {
                                                echo "<option value='" . $departamentos->cod_dep . "'";
                                                    if ($departamentos->cod_dep == $departamento) {echo " selected";}
                                                echo ">" . $departamentos->departamento . "</option>";
                                        }
                                    ?>
                                </select>                            
                            </div>
                            <div class="oferta_ciudad oferta_ciudad2">
                                <img src="../img/inicio/icono ubicacion barra busqueda.svg" alt="ubicacion">
                                <select class="form-control" id="municipios" aria-label="municipio">
                                    <option disabled selected>Municipio</option>
                                    <?php
                                        if ($_GET['departamento'] !== "null") {
                                            foreach ($insert_ob_mun as $municipios) {
                                                if ($municipios->cod_dep == $_GET['departamento']) {
                                                    echo "<option value='" . $municipios ->  cod_mun .  "'";
                                                        if ($municipios->cod_dep == $_GET['departamento'] && $municipios->cod_mun == $municipio) {echo " selected";}
                                                    echo ">" . $municipios -> municipio . "</option>";
                                                } 
                                            }    
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="oferta_empresa">
                                <img src="../img/inicio/icono maletin barra busqueda.svg" alt="cargo">
                                <select name="" id="nom_empresas" class="form-control">
                                        <option disabled selected>Empresa</option>
                                    <?php
                                        foreach ($infemp as $empresas) {     
                                    ?>
                                        <option value="<?php echo $empresas -> id_empresa ?>"> <?php echo $empresas -> razon_social ?> </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>                        
                        </div>
                        <button type="submit" id="btn_bus_ofe">
                            Buscar
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <section class="resultado_bus" id="cont_vac">
            
        </section>
        <section class="sec_btn">
            <button id="btn_ant" class="btn_mas">ANTERIOR</button>
            <button id="btn_sig" class="btn_mas">SIGUIENTE</button>
        </section>

        <!-- Redes -->
        <?php include_once ("./redes.php"); ?> 
    </main>

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
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function () {
            $('#btn_bus_ofe').click();

            $("#departamento").change(function () {
                var selectedValue = $(this).val();
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
                        $('#municipios').html(plantilla);
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