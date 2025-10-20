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

$usuario = $_SESSION["id_empr"];

$query = "SELECT * FROM vacante vc, municipio mc WHERE id_empresa = '$usuario' AND vc.municipio = mc.cod_mun ORDER BY id_vacante DESC";
$insert = $conexion->prepare($query);
$insert->execute();
$infvac = $insert->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM departamentos";
$insert = $conexion->prepare($query);
$insert->execute();
$insert_ob = $insert->fetchAll(PDO::FETCH_OBJ);

$process = "";

$logo_empresa = '../' . $_SESSION["log_emp"];

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
                    <div class="cont_ftn_btn_emp">
                        <img src="<?php echo $logo_empresa ; ?>" alt="Foto de usuario">
                    </div>
                    <button id="dropdown-button" class="per_nat">
                        <input type="checkbox" name="" id="nav__checkbox_1" class="nav__checkbox_2">
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
                                    <img src="<?php echo $logo_empresa ; ?>" alt="Foto de usuario">
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
    <main class="cuerpo">
        <div class="cuerpo_emp_1" id="cuerpo_emp_1">
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
                                echo $_SESSION["razon_s"];
                            ?>
                        </h2>
                        <img src="<?php echo $logo_empresa ; ?>" alt="logo_empresa">
                    </div>
                    <div class="sliter_der">
                        <button class="edi_sliter" id="edi_per_emp">
                            Editar Perfil
                        </button>
                    </div>
                </div> 
            </section>

            <section class="cuerpo_inf">
                <div class="cuerpo_inf_quien">
                    <h2 class="quien_somos">
                        Acerca de <?php echo $_SESSION["razon_s"];?>
                    </h2>
                    <p class="descrip_empresa">
                        <?php
                            echo $_SESSION["des_emp"];
                        ?>
                    </p>
                </div>
                <div class="cuerpo_inf_img">
                    <div class="inf_img_cont">
                        <img src="<?php echo '../' . $_SESSION["fot_emp"]; ?>" alt="img_decoracion_1">
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
                            echo $_SESSION["mision"];
                        ?>
                    </p>
                </div>
                <div class="vision">
                    <h2 class="quien_somos">
                        VISIÓN
                    </h2>
                    <p class="descrip_empresa">
                        <?php
                            echo $_SESSION["vision"];
                        ?>
                    </p>
                </div>
            </section>
        </div>

        <div class="cuerpo_emp_1" id="cuerpo_emp_2" style="display:none">
            <form id="act_for_emp">
                <section class="cuerpo_sliter">
                    <div class="sliter_completo_izq">
                        <div class="sliter_izq">
                            <h2>BIENVENIDO</h2>
                            <img src="../../img/inicio/Ojo vigiempleo.png" alt="vigiempleo">
                        </div>
                    </div>

                    <div class="sliter_completo_der_emp">
                        <div class="sliter_centro_mod">
                            <h2 class="nom_empresa">
                                <input type="text" name="Razon_social" id="razon_social_emp" placeholder="Razón social" class="input nombre_emp" value="<?php echo $_SESSION["razon_s"]; ?>">
                            </h2>
                            <div>
                                <div class="img_preview_logo">
                                    <img src="<?php echo $logo_empresa ; ?>" id="preview_logo_emp">
                                </div>
                                <div class="registro_img">
                                    <span class="archivo_logo reg__oculto">
                                        <input type="file" name="archivo" id="archivo_logo" >
                                    </span>
                                    <label for="archivo_logo">
                                        <span class="reg__vis__archivo__logo">
                                                <img src="../../img/registro 1/CAMARA.svg" alt="camara">
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="sliter_der">
                            <button type="submit">
                                Guardar
                            </button>
                        </div>
                    </div>
                </section>

                <section class="cuerpo_inf">
                    <div class="cuerpo_inf_quien">
                        <h2 class="quien_somos">
                            Acerca de <?php echo $_SESSION["razon_s"];?>
                        </h2>
                        <p class="descrip_empresa">
                            <textarea name="descripcion" id="contacto_area_emp_emp" cols="30" rows="10" placeholder="Describe a tu empresa ¿a qué se dedica?" class="descrip_emp"><?php echo $_SESSION["des_emp"]; ?></textarea>
                        </p>
                    </div>
                    <div class="cuerpo_inf_img">
                        <div class="inf_img_cont">
                            <div class="registro_foto">
                                <div class="img_preview">
                                    <img src="<?php echo '../' . $_SESSION["fot_emp"]; ?>" id="preview_emp">
                                </div>
                                <div class="registro_img">
                                    <span class="archivo reg__oculto">
                                        <input type="file" name="archivo" id="archivo_foto_emp" >
                                    </span>
                                    <label for="archivo_foto_emp">
                                        <span class="reg__vis__archivo">
                                                <img src="../../img/registro 1/CAMARA.svg" alt="">
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="cuerpo_mis_vis">
                    <div class="mision">
                        <h2 class="quien_somos">
                            MISIÓN
                        </h2>
                        <p class="descrip_empresa">
                            <textarea name="mision" id="mision_emp_emp" cols="30" rows="10" placeholder="Agrege porfavor la mision de la empresa" class="mision_area"> <?php echo $_SESSION["mision"]; ?></textarea>
                        </p>
                    </div>
                    <div class="vision">
                        <h2 class="quien_somos">
                            VISIÓN
                        </h2>
                        <p class="descrip_empresa">
                            <textarea name="vision" id="vision_emp_emp" cols="30" rows="10" placeholder="Agrege porfavor la vision de la empresa" class="vision_area"><?php echo $_SESSION["vision"]; ?></textarea>
                        </p>
                    </div>
                </section>
            </form>    
        </div>

        <section class="cuerpo_aspirantes" id="sec_ofer">
            <div class="cont_btn">
                <button id="btn_tus_ofertas" class="btn_div">
                    TUS OFERTAS
                </button>
                <button id="btn_new_ofer" class="btn_div">
                    NUEVA OFERTA
                </button>
            </div>
            <div class="div_inf_cont">
                <ul id="ul_inf">
                    <li id="cuerpo_vacantes" class="cuerpo_vacantes">
						<section>
                            <?php
                                foreach($infvac as $vacantes){
                                    if ($vacantes -> id_empresa == $usuario) {

                                    }   
                            ?>
                                
                                <br>
                                <div class="cuerpo_car">
                                    <div class="info_car">
                                        <p class="cargo"><b><?php echo $vacantes -> nom_vacante ?></b></p>
                                        <p class="ubicacion"><?php echo $vacantes -> municipio ?></p>
                                        <p class="salario"><?php echo $vacantes -> salario ?></p>
                                    </div>
                                    <div class="cont_btn_car">
                                        <button class="btn_car" id="btn_car<?php echo $vacantes -> id_vacante?>" onclick="" value="<?php echo $vacantes -> id_vacante ?>">
                                            CONOCER ASPIRANTES
                                        </button>
                                    </div>
                                    <div class="logo_empresa">
                                        <img src="<?php echo $logo_empresa ; ?>" id="logo_empresa">
                                    </div>
                                    <button class="btn_edi" id="btn_edi<?php echo $vacantes -> id_vacante?>" onclick="" value="<?php echo $vacantes -> id_vacante ?>">
                                        EDITAR
                                    </button>
                                </div>
                                <div class="cont_aspi" id="cont_aspi<?php echo $vacantes -> id_vacante ?>" style="display: none">

                                </div>

                            <?php
                                }
                            ?>
                        </section>

                        <section class="sec_btn">
                            <button id="btn_ant_asp" class="btn_mas">ANTERIOR</button>
                            <button id="btn_sig_asp" class="btn_mas">SIGUIENTE</button>
                        </section>
                    </li>
                    
                    <li class="li_dif">
                        <h2>ENCUENTRA EL PERSONAL PARA TU EMPRESA</h2>
                        <div class="form_new_vac">
                            <form id="form_vacante">
                                <h3>NUEVA OFERTA</h3>
                                <select name="" id="nom_vacante" class="input">
                                    <option disabled selected>Cargo</option>
                                    <option value="VIGILANTE DE SEGURIDAD">VIGILANTE DE SEGURIDAD</option>
                                    <option value="SUPERVISOR DE SEGURIDAD">SUPERVISOR DE SEGURIDAD</option>
                                    <option value="ESCOLTA">ESCOLTA</option>
                                    <option value="OPERADOR DE MEDIOS TECNOLÓGICOS">OPERADOR DE MEDIOS TECNOLÓGICOS</option>
                                </select>
                                <textarea name="" id="des_vacante" cols="30" rows="10" class="input" placeholder="Descripcion de la vacante"></textarea>
                                <input type="number" name="" id="sal_vacante" class="input" placeholder="Salario de la vacante">
                                <select class="form-control input" id="departamento_vac" aria-label="departamento">
                                    <option disabled selected>Departamento</option>
                                    <?php
                                        foreach ($insert_ob as $departamento) {
                                            echo "<option value='" . $departamento ->  cod_dep .  "'>" . $departamento -> departamento . "</option>";
                                        }                                        
                                    ?>
                                </select>
                                <select class="form-control input" id="municipios_vac" aria-label="municipio">
                                    <option disabled selected>Municipio</option>
                                </select>
                                <button type="submit" >
                                    Publicar
                                </button>
                            </form>
                        </div>                        
                    </li>
                </ul>
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

    <div id="contEdit" class="contEdit">
        <div class="contIntEdit" id="contIntEdit">
            <div class="contCompEdit" id="contCompEdit">
                <form id="form_act_vac">
                    <div id="cuerpoIntEdit" class="cuerpoIntEdit"></div>    
                    <div class="btn_edit_vac" id="btn_edit_vac">
                        <button type="submit" class="btn_ace_vac btn" id="btn_ace_vac">ACEPTAR</button>
                        <button class="btn_can_vac btn" id="btn_can_vac">CANCELAR</button>
                        <button class="btn_eli_vac btn" id="btn_eli_vac">ELIMINAR VACANTE</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>

    <div id="contEli" class="contEli">
        <div class="contIntEli" id="contIntEli">
            <div class="contCompEli" id="contCompEli">
                <div id="cuerpoIntEli" class="cuerpoIntEli">
                    <h3>*** ESTA SEGURO DE QUE DESEA ELIMINAR ESTA VACANTE ***</h3>
                </div>
                <div>
                    <button id="btn_ace_eli">ACEPTAR</button>
                    <button id="btn_can_eli">CANCELAR</button>
                </div>  
            </div>    
        </div>
    </div>
	
	<div id="contGlobal" class="contGlobal">
        <div class="contInt" id="contInt">
            <div class="contComp" id="contComp">
                <div id="cuerpoInt" class="cuerpoInt"></div>    
                <button id="btn_aceptar">ACEPTAR</button>
                <button id="btn_fallo">CERRAR</button>
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
	<script>
        $(document).ready(function () {
            $("#municipios_vac").prop("disabled", true);
            $("#departamento_vac").change(function () {
                var selectedValue = $(this).val();

                $("#municipios_vac").prop("disabled", false);
                $.ajax({
                    type: "POST",
                    url: "../../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);
                        var plantilla = '<option disabled selected>Municipio</option>';
                        datos.forEach(dato => {
                            plantilla += "<option value=" + dato.cod_mun + ">" + dato.municipio + "</option>";
                        });
                        console.log(plantilla);
                        $('#municipios_vac').html(plantilla);
                    },
                    error: function () {
                        console.error("Error al obtener municipios");
                    }
                });
            });
			$(document).on('change', '#departamento_vacante_edi', function () {
                var selectedValue = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);
                        var plantilla = '<option disabled selected>Municipio</option>';
                        datos.forEach(dato => {
                            plantilla += "<option value=" + dato.cod_mun + ">" + dato.municipio + "</option>";
                        });
                        console.log(plantilla);
                        $('#municipio_vacante_edi').html(plantilla);
                    },
                    error: function () {
                        console.error("Error al obtener municipios");
                    }
                });
            });
        });
    </script>
    <?php
        if ($_GET['process'] == "edi_per") {
            $process = $_GET['process'];
    ?> 
            <script>
                $(document).ready(function () {
                    $('#cuerpo_emp_2').show();
                    $('#cuerpo_emp_1').hide();
                });
            </script>
    <?php
        }
    ?> 
</body>
</html>