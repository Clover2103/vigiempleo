<?php

session_start();

if (isset($_SESSION["num_doc"])) {
    header("location: natural/inicio.php");
}

if (isset($_SESSION["id_empr"])) {
    header("location: empresa/inicio.php");
}

include_once ("../conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto -> conexionBD();

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/Ojo vigiempleo cuadrado.ico">
    <link rel="stylesheet" href="../css/registro_empresa.css">
    <title>Vigiempleo - Registro empresarial</title>
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
        <form class="cuerpo_registro" id="cuerpo_registro_emp">
            <div class="registro_foto">
                <div class="img_preview">
                    <img src="../img/registro 1/img_dec_emp.png" id="preview_emp">
                </div>
                <div class="registro_img">
                    <span class="archivo reg__oculto">
                        <input type="file" name="archivo" id="archivo_foto_emp" >
                    </span>
                    <label for="archivo_foto_emp">
                        <span class="reg__vis__archivo">
                                <img src="../img/registro 1/CAMARA.svg" alt="">
                        </span>
                    </label>
                </div>
                <p id="valueInputName" class="valueInput">

                </p>
                <p id="inputValue" class="valueInput">

                </p>
            </div>
            <div class="container_forms">
                <ul id="section_ul_emp">

                    <!-- INFORMACION GENERAL -->
                    <li class="inf_gen">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    INFORMACIÓN GENERAL
                                </h2>
                                
                                <div class="container mb-3 mt-3">

                                    <!-- Razon social y numero NIT -->
                                    <div class="row g-2">

                                        <!-- Razon social -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="text" name="Razon_social" id="razon_social" placeholder="Razón social" class="form-control w-100 m-1">
                                                <label for="razon_social">Razon social <span>*</span></label>

                                            </div>
                                        </div>

                                        <!-- Numero NIT -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="number" name="nit" id="nit" placeholder="NIT" class="form-control w-100 m-1">
                                                <label for="nit">Numero NIT <span>*</span></label>

                                            </div>
                                        </div>

                                        <script>
                                            document.getElementById("nit").addEventListener("change", function() {
                                                let nit = this.value;

                                                // Validamos que no esté vacío
                                                if(nit.trim() === "") return;

                                                // Llamada AJAX con fetch a tu PHP
                                                fetch("../obtener_datos/empresa/validar_nit.php", {
                                                    method: "POST",
                                                    headers: {
                                                        "Content-Type": "application/x-www-form-urlencoded"
                                                    },
                                                    body: "nit=" + encodeURIComponent(nit)
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    let mensajeDiv = document.getElementById("cont_msg_emp");
                                                    let mensajeCont = document.getElementById("cont_error_emp");

                                                    if(data.existe){
                                                        mensajeDiv.innerHTML = "<span style='color: red; font-weight: bold; font-size: 16px;'>⚠ EL NUMERO NIT YA ESTA REGISTRADO</span>";
                                                        mensajeCont.style.display = "block";
                                                    }
                                                })
                                                .catch(error => console.error("Error:", error));
                                            });
                                        </script>

                                    </div>

                                    <!-- Text area de descripcion -->
                                    <div class="row">

                                        <!-- Contenedor de la descripcion -->
                                        <div class="col-md-12">
                                            <div class="form-floating">

                                                <textarea name="descripcion" id="contacto_area_emp" class="form-control w-100 m-1" style="height: 225px; resize: none;" placeholder="Describe a tu empresa ¿a qué se dedica?"></textarea>
                                                <label for="contacto_area_emp" class="label-text-area">¿Quienes son? <span>*</span></label>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <!-- Botones de control -->
                                <div class="row g-2 mb-3 mt-3">

                                    <div class="col-md-12 btn-center">

                                        <button class="btn_sig_inf_gen btn_sig" id="btn_sig_inf_gen_emp">
                                            Siguiente
                                        </button>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </li>

                    <!-- INFORMACION DE CONTACTO -->
                    <li class="inf_cont">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    INFORMACIÓN DE CONTACTO
                                </h2>

                                <div class="container mb-3 mt-3">

                                    <!-- Departamento y municipio -->
                                    <div class="row g-2">

                                        <!-- Departamento -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <select class="form-select w-100 m-1" id="departamento_emp" aria-label="departamento">
                                                    <option value="--">-</option>
                                                    <?php
                                                        foreach ($insert_ob as $departamento) {
                                                            echo "<option value='" . $departamento ->  cod_dep .  "'>" . $departamento -> departamento . "</option>";
                                                        }                                        
                                                    ?>
                                                </select>
                                                <label for="departamento_emp">Departamento <span>*</span></label>

                                            </div>
                                        </div>

                                        <!-- Municipio -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <select class="form-select w-100 m-1" id="municipios_emp" aria-label="municipio">
                                                    <option value="--">-</option>
                                                </select>
                                                <label for="municipios_emp">Municipio <span>*</span></label>

                                            </div>
                                        </div>

                                    </div>
                                    
                                    <!-- Correo electronico y confirmacion de correo electronico -->
                                    <div class="row g-2">
                                    
                                        <!-- Correo electronico -->
                                        <div class="col-md">

                                            <div class="form-floating">

                                                <input type="email" name="correo" id="correo_emp" placeholder="Correo electronico" class="form-control w-100 m-1">
                                                <label for="correo_emp">Correo electronico <span>*</span></label>

                                            </div>

                                        </div>

                                        <!-- Confirmacion de correo electronico -->
                                        <div class="col-md">

                                            <div class="form-floating">
                                                
                                                <input type="email" name="correo" id="correo_emp_conf" placeholder="Confirmar correo electronico" class="form-control w-100 m-1">
                                                <label for="correo_emp_conf">Confirmar correo electronico <span>*</span></label>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- Contraseña y confirmación de contraseña -->
                                    <div class="row g-2">

                                        <!-- Contraseña -->
                                        <div class="col-md">
                                            <div class="input-group">

                                                <!-- Input de contraseña -->
                                                <div class="form-floating" style="width: 80%;">

                                                    <input type="password" name="contrasena" id="contrasena_emp" class="form-control m-1 w-100" placeholder="Contraseña">
                                                    <label for="contrasena_emp">Contraseña <span>*</span></label>

                                                </div>

                                                <!-- Botón de mostrar/ocultar contraseña -->
                                                <div class="form-floating" style="width: 20%;">

                                                    <span class="input-group-text form-control w-100 m-1 p-1" style="background-color: #fff;">
                                                        <button id="btn_ver_cont_emp" class="btn " type="button" style="width: 100%; height: 100%;">
                                                            <img src="../img/registro 1/ojo_abierto.jpg" alt="ojo contraseña">
                                                        </button>
                                                    </span>

                                                </div>

                                            </div>                                            
                                        </div>

                                        <!-- Confirmación de contraseña -->
                                        <div class="col-md">
                                            <div class="input-group">

                                                <!-- Input de la contraseña -->
                                                <div class="form-floating" style="width: 80%;">

                                                    <input type="password" name="contrasena" id="confir_contrasena_emp" class="form-control m-1 w-100" placeholder="Confirmar contraseña">
                                                    <label for="confir_contrasena_emp">Confirmar contraseña <span>*</span></label>

                                                </div>

                                                <!-- Botón de mostrar/ocultar contraseña -->
                                                <div class="form-floating" style="width: 20%;">

                                                    <span class="form-control w-100 m-1 p-1" style="background-color: #fff; ">
                                                        <button id="btn_ver_cont_conf_emp" class="btn p-0 m-0" type="button" style="width: 100%; height: 100%;">
                                                            <img src="../img/registro 1/ojo_abierto.jpg" alt="ojo contraseña">
                                                        </button>
                                                    </span>

                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Direccion y telefono de contacto -->
                                    <div class="row g-2">

                                        <!-- Direccion -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="text" name="direccion" id="direccion_emp" placeholder="Dirección" class="form-control w-100 m-1">
                                                <label for="direccion_emp">Dirección <span>*</span></label>
                                            
                                            </div>
                                        </div>

                                        <!-- Telefono de contacto -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="tel" name="celular" id="celular_emp" placeholder="Celular" class="form-control w-100 m-1"> 
                                                <label for="celular_emp">Telefono <span>*</span></label>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">

                                            <button class="btn_atr_cont btn_atr" id="btn_atr_cont_emp">
                                                Atras
                                            </button>        

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig_inf_gen btn_sig" id="btn_sig_cont_emp">
                                                Siguiente
                                            </button>        

                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- MISION Y VISION -->
                    <li class="inf_cont">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    MISIÓN Y VISIÓN
                                </h2>

                                <!-- Mision y vision -->
                                <div class="container mb-3 mt-3">

                                    <!-- Mision empresarial -->
                                    <div class="col-md mb-2 mt-2">

                                        <div class="form-floating">

                                            <textarea name="mision" id="mision_emp" class="form-control m-1" style="height: 180px; resize: none;" placeholder="Agrege porfavor la mision de la empresa"></textarea>
                                            <label for="mision_emp" class="label-text-area">Mision empresarial<span>*</span></label>

                                        </div>

                                    </div>

                                    <!-- Vision empresarial -->
                                    <div class="col-md mb-2 mt-2">

                                        <div class="form-floating">
                                        
                                            <textarea name="vision" id="vision_emp" class="form-control m-1" style="height: 180px; resize: none;" placeholder="Agrege porfavor la vision de la empresa"></textarea>
                                            <label for="vision_emp"  class="label-text-area">Vision empresarial <span>*</span></label>

                                        </div>

                                    </div>
                                    
                                </div>

                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">

                                            <button class="btn_atr_mi_vi btn_atr" id="btn_atr_mi_vi">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig_mi_vi btn_sig" id="btn_sig_mi_vi">
                                                Siguiente
                                            </button>

                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- LOGO EMPRESARIAL -->
                    <li class="inf_cont">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    LOGO DE LA EMPRESA
                                </h2>
                                
                                <div class="container mb-3 mt-3">
                                    
                                    <h3>
                                        PREVISUALIZACIÓN DEL LOGO DE TU EMPRESA
                                    </h3>

                                    <!-- Contenedor del logo -->
                                    <div class="img_preview_logo">
                                        <img src="../img/registro 1/img_logo_emp.png" id="preview_logo_emp">
                                    </div>

                                    <!-- Input del documento con el label de camara -->
                                    <div class="registro_img">
                                        <span class="archivo_logo reg__oculto">
                                            <input type="file" name="archivo" id="archivo_logo" >
                                        </span>
                                        <label for="archivo_logo">
                                            <span class="reg__vis__archivo__logo">
                                                    <img src="../img/registro 1/CAMARA.svg" alt="camara">
                                            </span>
                                        </label>
                                    </div>

                                </div>

                                <!-- Aceptar terminos y condiciones -->
                                <p>HE LEIDO Y ACEPTO LOS <a id="cont_termino"><b>TERMINOS Y CONDICIONES </b></a><input type="checkbox" name="termino" id="termino_emp"></p>
                                
                                <!-- Botones de control -->
                                <div>

                                    <div class="row">

                                        <div class="col-md">

                                            <button class="btn_atr_log btn_atr" id="btn_atr_log">
                                                Atras
                                            </button>

                                        </div>
                                        
                                        <div class="col-md">

                                            <button class="btn_fin" id="btn_env_emp" disabled style="opacity: 0.5">
                                                Finalizar
                                            </button>

                                        </div>

                                    </div>
                                    
                                    
                                </div>

                                <!-- VENTANA EMERGENTE PARA VERIFICACION DE TOKEN -->
                                <div id="Cont_token" class="Cont_faltante">
                                    <div class="wind_msg" id="wind_token">
                                        <div class="contWinMsg" id="contWinToken">
                                            <div id="cont_msg_token" class="cont_msg" style="overflow-y: none;">
                                                Se realiza el envió de verificación del correo electrónico <span id="msg_mail"></span>       
                                                <br> POR FAVOR DILIGENCIA SU TOKEN DE VERIFICACION A CONTINUACIÓN  <br><br>
                                                <div class="form-floating">

                                                    <input type="text" name="token" id="contDeToken" placeholder="Token de verificación" class="form-control">
                                                    <label for="contDeToken">Token de verificación</label>
                                                
                                                </div>
                                                <div id="invisible">
                                                    
                                                </div>
                                                <button type="submit" id="btn_acp_token" class="btn_atr" disabled style="opacity: 0.5">
                                                    VERIFICAR
                                                </button>
                                                <button id="btn_can_token" class="btn_atr">
                                                    CANCELAR
                                                </button>
                                            </div>
                                        </div>    
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </form>
    </main>

    <div id="cont_error_emp" class="cont_error_emp">
        <div class="wind_msg_emp" id="wind_msg_emp">
            <div class="contWinMsgEmp" id="contWinMsgEmp">
                <div id="cont_msg_emp" class="cont_msg_emp"></div>
                <button id="acVenEmEm">ACEPTAR</button>
            </div>    
        </div>
    </div>

    <div id="Cont_faltante" class="Cont_faltante">
        <div class="wind_msg" id="wind_msg">
            <div class="contWinMsg" id="contWinMsg">
                <div id="cont_msg" class="cont_msg"></div>
                <button id="acVenEm">ACEPTAR</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/main.js"></script>

	<script>
        $(document).ready(function () {
            $("#municipio_emp").prop("disabled", false);
            $("#departamento_emp").change(function () {
                var selectedValue = $(this).val();

                $("#municipio_emp").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);
                        var plantilla = '<option value="--">-</option>';
                        datos.forEach(dato => {
                            plantilla += "<option value=" + dato.cod_mun + ">" + dato.municipio + "</option>";
                        });
                        console.log(plantilla);
                        $('#municipios_emp').html(plantilla);
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