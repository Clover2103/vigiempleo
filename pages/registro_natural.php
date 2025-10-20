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

$query = "SELECT * FROM cargos";
$smtm = $conexion->prepare($query);
$smtm->execute();
$inf_car = $smtm->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM nivel_academico";
$smtm = $conexion->prepare($query);
$smtm->execute();
$inf_na = $smtm->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM ciclo_capacitacion";
$smtm = $conexion->prepare($query);
$smtm->execute();
$inf_cc = $smtm->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * FROM ciclo_cualificacion";
$smtm = $conexion->prepare($query);
$smtm->execute();
$inf_cu = $smtm->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/Ojo vigiempleo cuadrado.ico">
    <link rel="stylesheet" href="../css/registro_natural.css">
    <title>Vigiempleo - Registro persona natural</title>
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

            <input type="checkbox" name="nav__checkbox" id="nav__checkbox" class="nav__checkbox">
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
        <form class="cuerpo_registro" id="cuerpo_registro_nat">
            <div class="registro_foto">
                <div class="img_preview">
                    <img src="../img/registro 1/foto_usu.png" id="preview" alt="foto usuario natural">
                </div>
                <div class="registro_img">
                    <div>
                        <span class="archivo reg__oculto">
                            <input type="file" name="archivo" id="archivo" >
                        </span>
                    </div>
                    <label for="archivo">
                        <span class="reg__vis__archivo">
                                <img src="../img/registro 1/CAMARA.svg" alt="camara">
                        </span>
                    </label>
                </div>
                <p id="valueInputName" class="valueInputName">

                </p>
                <p id="valueInput" class="valueInput">

                </p>
            </div>
            <div class="container_forms">
                <ul id="section_ul">
                    
                    <!-- INFORMACION GENERAL -->
                    <li class="inf_gen">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    INFORMACIÓN GENERAL
                                </h2>

                                <div class="container mb-3 mt-3">

                                    <!-- Nombres -->
                                    <div class="row g-2">

                                        <!-- Primer nombre -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="text" name="primer_nombre" placeholder="Primer nombre" class="form-control m-1 w-100" id="primer_nombre" oninput="this.value = this.value.toUpperCase()">
                                                <label for="primer_nombre">Primer nombre <span> *</span></label>
                                            
                                            </div>
                                        </div>

                                        <!-- Segundo nombre -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="text" name="segundo_nombre" placeholder="Segundo nombre" class="form-control m-1 w-100" id="segundo_nombre" oninput="this.value = this.value.toUpperCase()">
                                                <label for="segundo_nombre">Segundo nombre</label>
                                            
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <!-- Apellidos -->
                                    <div class="row g-2">

                                        <!-- Primer apellido -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="text" name="primer_apellido" placeholder="Primer apellido" class="form-control m-1 w-100" id="primer_apellido" oninput="this.value = this.value.toUpperCase()">
                                                <label for="primer_apellido">Primer apellido  <span> *</span></label>
                                            
                                            </div>
                                        </div>

                                        <!-- Segundo apellido -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="text" name="segundo_apellido" placeholder="Segundo apellido" class="form-control m-1 w-100" id="segundo_apellido" oninput="this.value = this.value.toUpperCase()">
                                                <label for="segundo_apellido">Segundo apellido </label>
                                            
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Tipo documento, numero documento y sexo -->
                                    <div class="row g-2">

                                        <!-- Tipo de documento y numero de documento -->
                                        <div class="col-md">
                                            <div class="input-group">

                                                <!-- Tipo de documento -->
                                                <div class="form-floating" style="width: 30%">

                                                    <select name="tipo_de_documento" id="tipo_de_documento" class="form-select m-1" aria-label="documento">
                                                        <option value="--">-</option>
                                                        <option value="CC">CC (Cedula de ciudadania)</option>
                                                        <option value="CE">CE (Cedula de extrangeria)</option>
                                                        <option value="PA">PA (Pasaporte)</option>
                                                        <option value="PPT">PPT (Permiso por proteccion temporal)</option>
                                                    </select>
                                                    <label for="tipo_de_documento">Documento  <span> *</span></label>

                                                </div>

                                                <!-- Numero de documento -->
                                                <div class="form-floating" style="width: 70%">

                                                    <input type="number" name="cedula_de_ciudadania" id="cedula_de_ciudadania" placeholder="Numero de documento" class="form-control m-1 w-100">
                                                    <label for="cedula_de_ciudadania">Numero de documento  <span> *</span></label>

                                                </div>

                                                <script>
                                                    document.getElementById("cedula_de_ciudadania").addEventListener("change", function() {
                                                        let cedula = this.value;

                                                        // Validamos que no esté vacío
                                                        if(cedula.trim() === "") return;

                                                        // Llamada AJAX con fetch a tu PHP
                                                        fetch("../obtener_datos/natural/validar_cedula.php", {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/x-www-form-urlencoded"
                                                            },
                                                            body: "cedula=" + encodeURIComponent(cedula)
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            let mensajeDiv = document.getElementById("cont_msg");
                                                            let mensajeCont = document.getElementById("Cont_faltante");

                                                            if(data.existe){
                                                                mensajeDiv.innerHTML = "<span style='color: red; font-weight: bold; font-size: 16px;'>⚠ EL NUMERO DE DOCUMENTO YA ESTA REGISTRADO</span>";
                                                                mensajeCont.style.display = "block";
                                                            }
                                                        })
                                                        .catch(error => console.error("Error:", error));
                                                    });
                                                </script>

                                            </div>                                            
                                        </div>

                                        <!-- Sexo -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <select name="sexo" id="sexo" class="form-select m-1 w-100" aria-label="sexo">
                                                    <option value="--">-</option>
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                </select>
                                                <label for="sexo">¿Cual es tu sexo?  <span> *</span></label>

                                            </div>
                                        </div>
                                        
                                    </div>

                                    <!-- Fecha de nacimiento y edad -->
                                    <div class="row g-2 ">

                                        <!-- Fecha de nacimiento -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control m-1 w-100">
                                                <label for="fecha_nacimiento">Fecha de nacimiento  <span> *</span></label>

                                            </div>
                                        </div>

                                        <!-- Edad -->
                                        <div class="col-md">
                                            <div class="form-floating">

                                                <select name="edad" id="edad" class="form-select m-1 w-100" aria-label="edad">
                                                    <option value="--">-</option>
                                                    <?php
                                                        // Genera opciones para las edades desde 18 hasta 70
                                                        for ($i = 18; $i <= 70; $i++) {
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <label for="edad">¿Cual es tu edad?  <span> *</span></label>
                                            
                                            </div>
                                        </div>

                                        <script>
                                            // Obtener elementos del DOM
                                            let fechaNacimientoInput = document.getElementById("fecha_nacimiento");
                                            let edadSelect = document.getElementById("edad");

                                            // Agregar evento change al campo de fecha de nacimiento
                                            fechaNacimientoInput.addEventListener("change", function() {
                                                // Obtener la fecha de nacimiento seleccionada
                                                let fechaNacimiento = new Date(this.value);

                                                // Calcular la edad
                                                let hoy = new Date();
                                                let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                                                let mes = hoy.getMonth() - fechaNacimiento.getMonth();
                                                if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                                                    edad--;
                                                }

                                                // Seleccionar la opción de edad correspondiente
                                                edadSelect.value = edad.toString();
                                            });
                                        </script>
                                        
                                    </div>

                                    <!-- Ednia  -->
                                    <div class="row g-2">

                                        <div class="col-md">
                                            <div class="form-floating">

                                                <select name="ednia" id="ednia" class="form-select m-1 w-100" aria-label="etnia">
                                                    <option value="--">-</option>
                                                    <option value="Ninguna">Ninguna</option>
                                                    <option value="Indigena">Indigena</option>
                                                    <option value="Afrocolombiano">Afrocolombiano</option>
                                                    <option value="Raizal">Raizal</option>
                                                    <option value="Rom">Rom</option>
                                                </select>
                                                <label for="ednia">¿Cual es tu ednia?  <span> *</span></label>

                                            </div>
                                        </div>

                                        <div class="col-md">
                                            
                                        </div>

                                    </div>

                                </div>

                                <!-- Botones de control -->
                                <div class="btn-center mb-3 mt-3">

                                    <button class="btn_sig" id="btn_sig_inf_gen">
                                        Siguiente
                                    </button>

                                </div>

                            </div>
                        </div>
                    </li>

                    <!-- INFORMACION DE CONTACTO -->
                    <li class="inf_cont">
                        <div class="container for">
                            <div class="sec_form container">

                                <h2>
                                    CONTACTO
                                </h2>
                                
                                <div class="container mb-3 mt-3">

                                    <!-- Departamento y municipio -->
                                    <div class="row g-2">

                                        <!-- Departamento -->
                                        <div class="col-md">

                                            <div class="form-floating">

                                                <select class="form-control w-100 m-1" id="departamento" aria-label="departamento">
                                                    <option value="--">-</option>
                                                    <?php
                                                        foreach ($insert_ob as $departamento) {
                                                            echo "<option value='" . $departamento ->  cod_dep .  "'>" . $departamento -> departamento . "</option>";
                                                        }                                        
                                                    ?>
                                                </select>
                                                <label for="departamento">Departamento <span> *</span></label>

                                            </div>
                                        
                                        </div>

                                        <!-- Municipio -->
                                        <div class="col-md">

                                            <div class="col-md">
                                                <div class="form-floating w-100">

                                                    <select class="form-control w-100 m-1" id="municipios" aria-label="municipio">
                                                        <option value="--">-</option>
                                                    </select>
                                                    <label for="municipios">Municipio <span> *</span></label>

                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>

                                    <!-- Direccion y celular -->
                                    <div class="row g-2">

                                        <!-- Direccion -->
                                        <div class="col-md">

                                            <div class="form-floating">

                                                <input type="text" name="direccion" id="direccion" placeholder="Dirección de residencia" class="form-control w-100 m-1">
                                                <label for="direccion">Direccion de recidencia <span> *</span></label>

                                            </div>
                                        
                                        </div>

                                        <!-- Celular -->
                                        <div class="col-md">

                                            <div class="col-md">
                                                <div class="form-floating">

                                                    <input type="number" name="celular" id="celular_cont" placeholder="Celular" class="form-control w-100 m-1">
                                                    <label for="celular_cont">Numero celular <span> *</span></label>
                                                
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>

                                    <!-- Correo y confirmacion -->
                                    <div class="row g-2">

                                        <!-- Correo -->
                                        <div class="col-md">

                                            <div class="form-floating">

                                                <input type="email" name="correo" id="correo" placeholder="Correo electronico" class="form-control w-100 m-1">
                                                <label for="correo">Correo electronico <span> *</span></label>

                                            </div>
                                        
                                        </div>

                                        <!-- Confirmacion de correo -->
                                        <div class="col-md">

                                            <div class="col-md">
                                                <div class="form-floating">

                                                    <input type="email" name="correo_conf" id="correo_conf" placeholder="Correo electronico" class="form-control w-100 m-1">
                                                    <label for="correo_conf">Confirmar correo electronico <span> *</span></label>

                                                </div>
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

                                                    <input type="password" name="contrasena" id="contrasena" class="form-control m-1 w-100"  placeholder="Contraseña">
                                                    <label for="contrasena">Contraseña <span>*</span></label>

                                                </div>

                                                <!-- Botón de mostrar/ocultar contraseña -->
                                                <div class="form-floating" style="width: 20%;">

                                                    <span class="input-group-text form-control w-100 m-1 p-1" style="background-color: #fff;">
                                                        <button id="btn_ver_cont" class="btn " type="button" style="width: 100%; height: 100%;">
                                                            <img src="../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
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

                                                    <input type="password" name="conf_contrasena" id="conf_contrasena" class="form-control m-1 w-100" placeholder="Contraseña">
                                                    <label for="conf_contrasena">Confirmar contraseña <span>*</span></label>

                                                </div>

                                                <!-- Botón de mostrar/ocultar contraseña -->
                                                <div class="form-floating" style="width: 20%;">

                                                    <span class="form-control w-100 m-1 p-1" style="background-color: #fff; ">
                                                        <button id="btn_ver_cont_conf" class="btn p-0 m-0" type="button" style="width: 100%; height: 100%;">
                                                            <img src="../img/registro 1/ojo_abierto.svg" alt="ojo contraseña">
                                                        </button>
                                                    </span>

                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Libreta y licencia -->
                                    <div class="row g-2">

                                        <!-- Si posee o no libreta y numero de la libreta -->
                                        <div class="col-md">
                                            <div class="input-group ">

                                                <!-- Posee o no libreta -->
                                                <div class="form-floating" style="width: 100%">

                                                    <select name="posee_lib" id="posee_lib" class="form-select m-1" aria-label="posee libreta">
                                                        <option value="--">-</option> 
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <label for="posee_lib">¿Posee Libreta?  <span> *</span></label>
                                                    
                                                </div>

                                                <!-- numero de la libreta -->
                                                <div class="form-floating" id="cont_num_lib" style="width: 50%; display: none;">

                                                    <input type="number" name="numero_lib" id="numero_lib" placeholder="numero de libreta" class="form-control m-1 w-100">
                                                    <label for="numero_lib">Numero de libreta  <span> *</span></label>

                                                </div>

                                            </div>                                            
                                        </div>

                                        <!-- Si posee o no licencia de conduccion, numero y categoria -->
                                        <div class="col-md">
                                            <div class="input-group">

                                                <!-- Posee o no licencia de conduccion -->
                                                <div class="form-floating" style="width: 100%">

                                                    <select name="posee_lic" id="posee_lic" class="form-select m-1" aria-label="posee licencia">
                                                        <option value="--">-</option> 
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <label for="posee_lic">¿Posee licencia?  <span> *</span></label>

                                                </div>

                                                <!-- numero y categoria -->
                                                <div class="form-floating" id="cont_num_lic" style="width: 50%; display: none;">

                                                    <div class="row g-2">

                                                        <!-- numero de categoria -->
                                                        <div class="form-floating" style="width: 60%;">

                                                            <input type="number" name="numero_lic" id="numero_lic" placeholder="numero licencia" class="form-control m-1 w-100">
                                                            <label for="numero_lic">Numero de licencia  <span> *</span></label>

                                                        </div>

                                                        <!-- Licencia acategoria -->
                                                        <div class="form-floating " style="width: 40%;">

                                                            <select name="posee_lib" id="cate_lic" class="form-select m-1 w-100" aria-label="categoria licencia">
                                                                <option value="--">-</option> 
                                                                <option value="A1">A1</option>
                                                                <option value="A2">A2</option>
                                                                <option value="B1">B1</option>
                                                                <option value="B2">B2</option>
                                                                <option value="B3">B3</option>
                                                                <option value="C1">C1</option>
                                                                <option value="C2">C2</option>
                                                                <option value="C3">C3</option>
                                                            </select>
                                                            <label for="cate_lic">Categoria <span> *</span></label>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <!-- Descripcion en texto de area -->
                                    <div class="form-floating">

                                        <textarea name="descripcion" class="form-control m-1" id="contacto_area" style="height: 100px; resize: none;" placeholder="Descripcion breve"></textarea>
                                        <label for="contacto_area" class="label-text-area"><p>Danos una descripcion de ti: <span> *</span></p></label>
                                    
                                    </div>
                                    
                                </div>
                                    
                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">
                                            
                                            <button class="btn_atr" id="btn_atr_cont">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig" id="btn_sig_cont">
                                                Siguiente
                                            </button>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- EXPERIENCIAS LABORALES -->
                    <li class="exp_lab">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    EXPERIENCIA LABORAL
                                </h2>

                                <div class="container mb-3 mt-3">

                                    <!-- PRIMERA REFERENCIA LABORAL -->
                                    <div class="border-bottom mb-3 mt-3">
                                        
                                        <!-- Nombre de la empresa y estado laboral -->
                                        <div class="row g-2">

                                            <!-- Nombre de la empresa -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="nombre_empresa" id="nombre_empresa" placeholder="Nombre de la empresa" class="form-control w-100 m-1">
                                                    <label for="nombre_empresa">Nombre de la empresa</label>
                                                
                                                </div>

                                            </div>

                                            <!-- Estado laboral -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="posee_lib" id="sig_trab" class="form-select w-100 m-1" aria-label="posee licencia">
                                                        <option value="--">-</option> 
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <label for="sig_trab">¿Sigue trabajando?</label>

                                                </div>

                                            </div>
                                        </div>

                                        <!-- Cargo desempeñado y otra opcion -->
                                        <div class="row g-2">
                                        
                                            <div class="col-md">

                                                <div class="row g-2">

                                                    <!-- Cargo -->
                                                    <div class="w-100">
                                                        
                                                        <div class="form-floating">

                                                            <select name="cargo" id="cargo" class="form-select w-100 m-1" aria-label="posee licencia">
                                                                <option value="--">-</option>
                                                                <?php
                                                                    foreach ($inf_car as $cargo) {
                                                                        echo "<option value='" . $cargo ->  cod_cargo .  "'>" . $cargo -> cargo . "</option>";
                                                                    }                                        
                                                                ?>
                                                            </select>
                                                            <label for="cargo">Cargo</label>

                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <!-- Otra opcion -->
                                                    <div class="w-100" id="cont_otro_cargo" style="display: none">

                                                        <div class="form-floating">

                                                            <input type="text" name="cargo_dese" id="cargo_dese" placeholder="Fecha de salida" class="form-control w-100 m-1" >
                                                            <label for="cargo_dese">¿Cual?</label>

                                                        </div>

                                                    </div>

                                                </div>
                                                                    
                                            </div>

                                            <!-- Fecha de ingreso y fecha de salida -->
                                            <div class="col-md">

                                                <div class="row g-2">

                                                    <!-- Fecha de ingreso -->
                                                    <div class="w-100">
                                                        
                                                        <div class="form-floating">

                                                            <input type="date" name="tiempo_ingreso_exp" id="tiempo_ingreso_exp" placeholder="Fecha de ingreso" class="form-control w-100 m-1">
                                                            <label for="tiempo_ingreso_exp">Fecha de ingreso</label>

                                                        </div>

                                                    </div>

                                                    <!-- Fecha de salida -->
                                                    <div class="w-100">

                                                        <div class="form-floating" id="cont_fec_sali" style="display: none">

                                                            <input type="date" name="tiempo_salida_1" id="tiempo_salida_1" placeholder="Fecha de salida" class="form-control w-100 m-1" >
                                                            <label for="tiempo_salida_1">Fecha de salida</label>
                                                        
                                                        </div>

                                                    </div>

                                                </div>
                                                            
                                            </div>
                                        
                                        </div>
                                        
                                        <!-- Nombre de jefe inmediato y numero de telefono jefe inmediato -->
                                        <div class="row g-2">
                                        
                                            <!-- Nombre jefe inmediato -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="jefe_inmediato" id="jefe_inmediato" placeholder="Jefe inmediato" class="form-control w-100 m-1">
                                                    <label for="jefe_inmediato">Nombre de jefe</label>

                                                </div>
                                                                    
                                            </div>

                                            <!-- Telefono jefe inmediato -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="tel" name="celular_exp" id="celular_exp" placeholder="Celular" class="form-control w-100 m-1">
                                                    <label for="celular_exp">Celular jefe inmediato</label>
                                                
                                                </div>
                                                            
                                            </div>
                                        
                                        </div>
                                        
                                        <!-- Carga de certificado -->
                                        <div class="row">
                                        
                                            <div class="col-md">
                                                
                                                <input type="file" name="compro_laboral" class="custom-file-input w-100 m-1" id="compro_laboral" style="display:none">
                                                <label for="compro_laboral" class="custom-file-label w-100">CARGAR CERTIFICADO</label>
                                
                                            </div>
                                        
                                        </div>
                                        
                                    </div>


                                    <!-- SEGUNDA REFERENCIA LABORAL -->
                                    <div class="border-bottom mb-3 mt-3" id="insertar_form_prin">
                                        
                                        <!-- Nombre de la empresa y estado laboral -->
                                        <div class="row g-2">

                                            <!-- Nombre de la empresa -->
                                            <div class="col-md">

                                                <div class="form-floating">
                                                    <input type="text" name="nombre_empresa_2" id="nombre_empresa_2" placeholder="Nombre de la empresa" class="form-control w-100 m-1">
                                                    <label for="nombre_empresa_2">Nombre de la empresa</label>
                                                </div>

                                            </div>

                                            <!-- Estado laboral -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="sig_trab_2" id="sig_trab_2" class="form-select w-100 m-1" aria-label="posee licencia">
                                                        <option value="--">-</option> 
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <label for="sig_trab_2">¿Sigue trabajando?</label>

                                                </div>

                                            </div>
                                        </div>

                                        <!-- Cargo desempeñado y otra opcion -->
                                        <div class="row g-2">
                                        
                                            <div class="col-md">

                                                <div class="row g-2">

                                                    <!-- Cargo -->
                                                    <div class="w-100">
                                                        
                                                        <div class="form-floating">

                                                            <select name="cargo_2" id="cargo_2" class="form-select w-100 m-1" aria-label="posee licencia">
                                                                <option value="--">-</option> 
                                                                <?php
                                                                    foreach ($inf_car as $cargo) {
                                                                        echo "<option value='" . $cargo ->  cod_cargo .  "'>" . $cargo -> cargo . "</option>";
                                                                    }                                        
                                                                ?>
                                                            </select>
                                                            <label for="cargo_2">Cargo</label>

                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <!-- Otra opcion -->
                                                    <div class="w-100" id="cont_otro_cargo_2" style="display: none">

                                                        <div class="form-floating">

                                                            <input type="text" name="cargo_dese_2" id="cargo_dese_2" placeholder="Fecha de salida" class="form-control w-100 m-1" >
                                                            <label for="cargo_dese_2">¿Cual?</label>

                                                        </div>

                                                    </div>

                                                </div>
                                                                    
                                            </div>

                                            <!-- Fecha de ingreso y fecha de salida -->
                                            <div class="col-md">

                                                <div class="row g-2">

                                                    <!-- Fecha de ingreso -->
                                                    <div class="w-100">
                                                        
                                                        <div class="form-floating">

                                                            <input type="date" name="tiempo_ingreso_exp_2" id="tiempo_ingreso_exp_2" placeholder="Fecha de ingreso" class="form-control w-100 m-1">
                                                            <label for="tiempo_ingreso_exp_2">Fecha de ingreso</label>
                                                        
                                                        </div>

                                                    </div>

                                                    <!-- Fecha de salida -->
                                                    <div class="w-100">

                                                        <div class="form-floating" id="cont_fec_sali_2" style="display: none">

                                                            <input type="date" name="tiempo_salida_2" id="tiempo_salida_2" placeholder="Fecha de salida" class="form-control w-100 m-1" >
                                                            <label for="tiempo_salida_2">Fecha de salida</label>
                                                        
                                                        </div>

                                                    </div>

                                                </div>
                                                            
                                            </div>
                                        
                                        </div>
                                        
                                        <!-- Nombre de jefe inmediato y numero de telefono jefe inmediato -->
                                        <div class="row g-2">
                                        
                                            <!-- Nombre jefe inmediato -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="jefe_inmediato_2" id="jefe_inmediato_2" placeholder="Jefe inmediato" class="form-control w-100 m-1">
                                                    <label for="jefe_inmediato_2">Nombre de jefe</label>
                                                
                                                </div>
                                                                    
                                            </div>

                                            <!-- Telefono jefe inmediato -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="tel" name="celular_exp_2" id="celular_exp_2" placeholder="Celular" class="form-control w-100 m-1">
                                                    <label for="celular_exp_2">Celular jefe inmediato</label>
                                                
                                                </div>
                                                            
                                            </div>
                                        
                                        </div>
                                        
                                        <!-- Carga de certificado -->
                                        <div class="row">
                                        
                                            <div class="col-md">
                                                    
                                                <input type="file" name="compro_laboral_2" class="custom-file-input w-100 m-1" id="compro_laboral_2" style="display:none">
                                                <label for="compro_laboral_2" class="custom-file-label w-100">CARGAR CERTIFICADO</label>
                                
                                            </div>
                                        
                                        </div>
                                        
                                    </div>

                                </div>

                                <!-- Boton de agregar segunda referencia -->
                                <button class="insertar_form mt-3 mb-3" id="insertar_form" aria-label="agregar">
                                    <img src="../img/registro 1/icono de +.svg" alt="agregar">
                                </button>

                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">
                                            
                                            <button class="btn_atr" id="btn_atr_exp_lab">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig" id="btn_sig_exp_lab">
                                                Siguiente
                                            </button>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- EDUCACION FORMAL -->
                    <li class="for_aca">
                        <div class="form">

                            <div class="sec_form container">
                                
                                <h2>
                                    EDUCACIÓN FORMAL
                                </h2>

                                <div class="container">
                                
                                    <!-- PRIMERA EDUCACION FORMAL -->
                                    <div class="border-bottom mb-3 mt-3">

                                        <!-- Nombre del instituto y nivel academico -->
                                        <div class="row g-2">

                                            <!-- Nombre del instituto -->
                                            <div class="col-md">
                                            
                                                <div class="form-floating">

                                                    <input type="text" name="nombre_instituto" id="nombre_instituto" placeholder="Nombre de instituto" class="form-control w-100 m-1">
                                                    <label for="nombre_instituto">Nombre del instituto</label>
                                                
                                                </div>

                                            </div>

                                            <!-- Nivel academico -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="nivel_academico" id="nivel_academico" class="form-select w-100 m-1" aria-label="nivel academico">
                                                        <option value="--">-</option>
                                                        <?php
                                                            foreach ($inf_na as $nivel) {
                                                                echo "<option value='" . $nivel ->  cod_na .  "'>" . $nivel -> nivel_academico . "</option>";
                                                            }                                        
                                                        ?>
                                                    </select>
                                                    <label for="nivel_academico">Nivel academico</label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Titulo obtenido y pregunta si termino -->
                                        <div class="row g-2">

                                            <!-- Titulo obtenido -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="titulo_op" id="titulo_op" placeholder="Titulo obtenido" class="form-control w-100 m-1">
                                                    <label for="titulo_op">Titulo obtenido</label>

                                                </div>

                                            </div>

                                            <!-- Pregunta si termino o no -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select id="culm_aca" class="form-select w-100 m-1" aria-label="culmino">
                                                        <option value="--">-</option> 
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <label for="culm_aca">¿Termino?</label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Carga de certificado, fecha de finalizacion y check de sigue estudiando -->
                                        <div class="row g-2">
                                        
                                            <!-- Carga de certificado -->
                                            <div class="col-md">

                                                <input type="file" name="comp_est_for" class="custom-file-input" id="comp_est_for" style="display:none">
                                                <label for="comp_est_for" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>

                                            <!-- Fecha de finalizacion y check de sigue estudiando -->
                                            <div class="col-md">

                                                <div class="row g-2">

                                                    <!-- Fecha de finalizacion -->
                                                    <div class="w-100" id="cont_fec_fin_est" style="display:none">

                                                        <div class="form-floating">

                                                            <input type="date" name="tiempo_fin_1" id="tiempo_fin_1" class="form-control w-100 m-1">
                                                            <label for="tiempo_fin_1">Fecha de finalización</label> 
                                                        
                                                        </div>
                                                        
                                                    </div>

                                                    <!-- Chack de sigue estudiando -->
                                                    <div class="w-100" id="cont_check_fin_est" style="display:none">

                                                        <div class="form-check form-switch m-1">

                                                            <input class="form-check-input" type="checkbox" role="switch" id="sigo_estu">
                                                            <label class="form-check-label" for="sigo_estu">¿Sigue estudiando?</label>
        
                                                        </div>  
                                                    
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <!-- SEGUNDA EDUCACION FORMAL -->
                                    <div class="border-bottom mb-3 mt-3" id="insertar_form_aca">

                                        <!-- Nombre del instituto y nivel academico -->
                                        <div class="row g-2">

                                            <!-- Nombre del instituto -->
                                            <div class="col-md">
                                            
                                                <div class="form-floating">

                                                    <input type="text" name="nombre_instituto_2" id="nombre_instituto_2" placeholder="Nombre de instituto" class="form-control w-100 m-1">
                                                    <label for="nombre_instituto_2">Nombre del instituto</label>
                                                
                                                </div>

                                            </div>

                                            <!-- Nivel academico -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="nivel_academico_2" id="nivel_academico_2" class="form-select w-100 m-1" aria-label="nivel academico">
                                                        <option value="--">-</option>
                                                        <?php
                                                            foreach ($inf_na as $nivel) {
                                                                echo "<option value='" . $nivel ->  cod_na .  "'>" . $nivel -> nivel_academico . "</option>";
                                                            }                                        
                                                        ?>
                                                    </select>
                                                    <label for="nivel_academico_2">Nivel academico</label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Titulo obtenido y pregunta si termino -->
                                        <div class="row g-2">

                                            <!-- Titulo obtenido -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="titulo_op_2" id="titulo_op_2" placeholder="Titulo obtenido" class="form-control w-100 m-1">
                                                    <label for="titulo_op_2">Titulo obtenido</label>

                                                </div>

                                            </div>

                                            <!-- Pregunta si termino o no -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select id="culm_aca_2" class="form-select w-100 m-1" aria-label="culmino">
                                                        <option value="--">-</option> 
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <label for="culm_aca_2">¿Termino?</label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Carga de certificado, fecha de finalizacion y check de sigue estudiando -->
                                        <div class="row g-2">

                                            <!-- Carga de certificado -->
                                            <div class="col-md">

                                                <input type="file" name="comprobante estudio" class="custom-file-input" id="comp_est_for_2" style="display:none">
                                                <label for="comp_est_for_2" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>

                                            <!-- Fecha de finalizacion y check de sigue estudiando -->
                                            <div class="col-md">

                                                <div class="row g-2">

                                                    <!-- Fecha de finalizacion -->
                                                    <div class="w-100" id="cont_fec_fin_est_2" style="display:none">

                                                        <div class="form-floating">

                                                            <input type="date" name="tiempo_fin_1" id="tiempo_fin_2" class="form-control w-100 m-1">
                                                            <label for="tiempo_fin_2">Fecha de finalización</label> 
                                                        
                                                        </div>
                                                        
                                                    </div>

                                                    <!-- Chack de sigue estudiando -->
                                                    <div class="w-100" id="cont_check_fin_est_2" style="display:none">

                                                        <div class="form-check form-switch m-1">

                                                            <input class="form-check-input" type="checkbox" role="switch" id="sigo_estu_2">
                                                            <label class="form-check-label" for="sigo_estu_2">¿Sigue estudiando?</label>

                                                        </div>  
                                                    
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <!-- Boton para insertar segunda formacion formar -->
                                <button class="insertar_form mb-3 mt-3" id="insertar_form_for_aca" aria-label="agregar">
                                    <img src="../img/registro 1/icono de +.svg" alt="agregar">
                                </button>

                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">
                                            
                                            <button class="btn_atr" id="btn_atr_form_aca">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig" id="btn_sig_for_aca">
                                                Siguiente
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </li>

                    <!-- OTROS: CURSOS, DIPLOMAS Y SEMINARIOS -->
                    <li>
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    OTROS: CURSOS, SEMINARIOS Y DIPLOMADOS
                                </h2>

                                <div class="container">

                                    <!-- PRIMERA SECCION DE OTROS CURSOS -->
                                    <div class="border-bottom mb-3 mt-3">

                                        <!-- Nombre del insituto y titulo obtenido -->
                                        <div class="row g-2">

                                            <!-- Nombre del instituto -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="nombre_instituto_otro" id="nombre_instituto_otro" placeholder="Nombre de instituto" class="form-control w-100 m-1">
                                                    <label for="nombre_instituto_otro">Nombre del instituto</label>

                                                </div>

                                            </div>

                                            <!-- Titulo obtenido -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="titulo" id="titulo_op_otro" placeholder="Titulo obtenido" class="form-control w-100 m-1">
                                                    <label for="titulo_op_otro">Titulo obtenido</label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Fecha de finalizacion y carga de certificado -->
                                        <div class="row g-2">

                                            <!-- Fecha de finalizacion -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="date" name="tiempo_fin_otro_1" id="tiempo_fin_otro_1" placeholder="Fecha de finalizacion" class="form-control w-100 m-1">
                                                    <label for="tiempo_fin_otro_1">Fecha de finalización</label>

                                                </div>

                                            </div>

                                            <!-- Carga de certificado -->
                                            <div class="col-md">

                                                <input type="file" name="comp_otro otro" class="custom-file-input" id="comp_otro" style="display:none">
                                                <label for="comp_otro" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- SEGUNDA SECCION DE OTROS CURSOS -->
                                    <div class="border-bottom mb-3 mt-3" id="insertar_cue_otro">

                                        <!-- Nombre del instituto y titulo obtenido -->
                                        <div class="row g-2">

                                            <!-- Nombre del instituto -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="nombre_instituto_otro_2" id="nombre_instituto_otro_2" placeholder="Nombre de instituto" class="form-control w-100 m-1">
                                                    <label for="nombre_instituto_otro_2">Nombre del instituto</label>

                                                </div>

                                            </div>

                                            <!-- Titulo obtenido -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="titulo_op_otro_2" id="titulo_op_otro_2" placeholder="Titulo obtenido" class="form-control w-100 m-1">
                                                    <label for="titulo_op_otro_2">Titulo obtenido</label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Fecha de finalizacion y carga de certificado -->
                                        <div class="row g-2">

                                            <!-- Fecha de finalizacion -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="date" name="tiempo_fin_otro_2" id="tiempo_fin_otro_2" placeholder="Fecha de finalizacion" class="form-control w-100 m-1">
                                                    <label for="tiempo_fin_otro_2">Fecha de finalización</label>

                                                </div>

                                            </div>

                                            <!-- Carga de certificado -->
                                            <div class="col-md">

                                                <input type="file" name="comp_otro_2" class="custom-file-input" id="comp_otro_2" style="display:none">
                                                <label for="comp_otro_2" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>

                                        </div>
                                    
                                    </div>

                                </div>
                                

                                <!-- Boton para agregar segunda formacion academica -->
                                <button class="insertar_form mb-3 mt-3" id="insertar_otro" aria-label="agregar">
                                    <img src="../img/registro 1/icono de +.svg" alt="agregar">
                                </button>

                                <!-- Botones de control -->
                                <div class="for_aca_btn">

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">
                                            
                                            <button class="btn_atr" id="btn_atr_otro">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig" id="btn_sig_otro">
                                                Siguiente
                                            </button>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>


                    <!-- CAPACITACIONES -->
                    <li class="for_aca">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    CAPACITACIONES
                                </h2>

                                <div class="container">

                                    <!-- PRIMERA CAPACITACION -->
                                    <div class="border-bottom mb-3 mt-3">

                                        <!-- Nombre del instituro y titulo de capacitacion -->
                                        <div class="row g-2">

                                            <!-- Nombre del instituto -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="" id="lug_capaci" class="form-control w-100 m-1" placeholder="Lugar donde se cualifico">
                                                    <label for="lug_capaci">Nombre instituto <span> *</span></label>

                                                </div>

                                            </div>

                                            <!-- Titulo de capacitacion -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="lug_capacita" id="lug_capacita" class="form-select w-100 m-1" aria-label="capacitacion">
                                                        <option value="--">-</option>
                                                        <?php
                                                            foreach ($inf_cc as $capacitacion) {
                                                                echo "<option value='" . $capacitacion ->  cod_cap .  "'>" . $capacitacion -> capacitacion . "</option>";
                                                            }                                        
                                                        ?>
                                                    </select>
                                                    <label for="lug_capacita">Titulo <span> *</span></label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Fecha de finalizacion y carga de certificado -->
                                        <div class="row g-2">

                                            <!-- Fecja de finalizacion -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="date" name="fech_capacita" id="fech_capacita" class="form-control w-100 m-1" placeholder="Fecha de finalizacion"  aria-label="fecha de capacitacion">
                                                    <label for="fech_capacita">Fecha de finalización <span> *</span></label>

                                                </div>

                                            </div>

                                            <!-- Carga de certificacion -->
                                            <div class="col-md">

                                                <input type="file" name="doc_capacita" id="doc_capacita" class="custom-file-input" style="display:none">
                                                <label for="doc_capacita" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- SEGUNDA CAPACITACION -->
                                    <div class="border-bottom mb-3 mt-3" id="capacita__insert">

                                        <!-- Nombre del instituro y titulo de capacitacion -->
                                        <div class="row g-2">

                                            <!-- Nombre del instituto -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="lug_capaci_2" id="lug_capaci_2" class="form-control w-100 m-1" placeholder="Lugar donde se cualifico">
                                                    <label for="lug_capaci_2">Nombre instituto</label>

                                                </div>

                                            </div>

                                            <!-- Titulo de capacitacion -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="lug_capacita_2" id="lug_capacita_2" class="form-select w-100 m-1" aria-label="capacitacion">
                                                        <option value="--">-</option>
                                                        <?php
                                                            foreach ($inf_cc as $capacitacion) {
                                                                echo "<option value='" . $capacitacion ->  cod_cap .  "'>" . $capacitacion -> capacitacion . "</option>";
                                                            }                                        
                                                        ?>
                                                    </select>
                                                    <label for="lug_capacita_2">Titulo</label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Fecha de finalizacion y carga de certificado -->
                                        <div class="row g-2">

                                            <!-- Fecja de finalizacion -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="date" name="fech_capacita_2" id="fech_capacita_2" class="form-control w-100 m-1" placeholder="Fecha de finalizacion"  aria-label="fecha de capacitacion">
                                                    <label for="fech_capacita_2">Fecha de finalización</label>

                                                </div>

                                            </div>

                                            <!-- Carga de certificacion -->
                                            <div class="col-md">

                                                <input type="file" name="doc_capacita_2" id="doc_capacita_2" class="custom-file-input" style="display:none">
                                                <label for="fech_capacita_2" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- Boton para agregar segunda capacitacion -->
                                <button class="insertar_form mb-3 mt-3" id="insertar_form_capacita" aria-label="agregar">
                                    <img src="../img/registro 1/icono de +.svg" alt="agregar">
                                </button>

                                <!-- Consulta de cualidicaciones -->
                                <div class="cualifi__container mb-3 mt-3" id="cualifi__container">
                                    <h3>
                                        ¿Cuenta con cualificación?
                                    </h3>
                                    <div class="cualifi__button mb-3 mt-3" id="cualifi__button">
                                        <button id="cualifi__button_si" class="cualifi__button_si">
                                            SI
                                        </button>
                                        <button id="cualifi__button_no" class="cualifi__button_no">
                                            NO
                                        </button>
                                        <input type="checkbox" name="checkNo" id="checkNo" style="display:none">
                                    </div>
                                </div>

                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">
                                            
                                            <button class="btn_atr" id="btn_atr_capacita">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig" id="btn_sig_capacita">
                                                Siguiente
                                            </button>

                                        </div>

                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- CUALIFICACIONES -->
                    <li class="cualifi__li" id="cualifi__li">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    CUALIFICACIONES
                                </h2>

                                <div class="container">

                                    <!-- PRIMERA CUALIFICACION -->
                                    <div class="border-bottom mb-3 mt-3">
                                        
                                        <!-- Nombre del instituto y certificado -->
                                        <div class="row g-2">
                                        
                                            <!-- Nombre del insituto -->
                                            <div class="col-md">

                                                <div class="form-floating">
                                                    
                                                    <input type="text" name="lug_cuali" id="lug_cuali" class="form-control w-100 m-1" placeholder="Lugar donde se cualifico">
                                                    <label for="lug_cuali">Instituto de certificacion</label>

                                                </div>

                                            </div>

                                            <!-- Titulo certificado -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="" id="lug_cualifica" class="form-control w-100 m-1" aria-label="cualificacion">
                                                        <option value="--">-</option>
                                                        <?php
                                                            foreach ($inf_cu as $cualificacion) {
                                                                echo "<option value='" . $cualificacion ->  cod_cuali .  "'>" . $cualificacion -> cualificacion . "</option>";
                                                            }                                        
                                                        ?>
                                                    </select>
                                                    <label for="lug_cualifica">Titulo cualificado</label>

                                                </div>

                                            </div>
                                    
                                        </div>

                                        <!-- Fecha de cualificacion y carga de certificado -->
                                        <div class="row g-2">
                                        
                                            <!-- Fecha de cualificacion -->
                                            <div class="col-md">

                                                <div class="form-floating">
                                                    
                                                    <input type="date" name="" id="fech_cualifi" class="form-control w-100 m-1">
                                                    <label for="fech_cualifi">Fecha de la cualificación</label>

                                                </div>

                                            </div>

                                            <!-- Carga de certificado -->
                                            <div class="col-md">
                                            
                                                <input type="file" name="" id="doc_cualifi" class="custom-file-input" style="display:none">
                                                <label for="doc_cualifi" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>
                                        
                                        </div>
                                    </div>

                                    <!-- SEGUNDA CUALIFICACION -->
                                    <div class="border-bottom mb-3 mt-3" id="cualifi__insert">
                                        
                                        <!-- Nombre del instituto y certificado -->
                                        <div class="row g-2">
                                        
                                            <!-- Nombre del insituto -->
                                            <div class="col-md">

                                                <div class="form-floating">
                                                    
                                                    <input type="text" name="lug_cuali_2" id="lug_cuali_2" class="form-control w-100 m-1" placeholder="Lugar donde se cualifico">
                                                    <label for="lug_cuali_2">Instituto de certificacion</label>

                                                </div>

                                            </div>

                                            <!-- Titulo certificado -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <select name="lug_cualifica_2" id="lug_cualifica_2" class="form-control w-100 m-1" aria-label="cualificacion">
                                                        <option value="--">-</option>
                                                        <?php
                                                            foreach ($inf_cu as $cualificacion) {
                                                                echo "<option value='" . $cualificacion ->  cod_cuali .  "'>" . $cualificacion -> cualificacion . "</option>";
                                                            }                                        
                                                        ?>
                                                    </select>
                                                    <label for="lug_cualifica_2">Titulo cualificado</label>

                                                </div>

                                            </div>
                                    
                                        </div>

                                        <!-- Fecha de cualificacion y carga de certificado -->
                                        <div class="row g-2">
                                        
                                            <!-- Fecha de cualificacion -->
                                            <div class="col-md">

                                                <div class="form-floating">
                                                    
                                                    <input type="date" name="fech_cualifi_2" id="fech_cualifi_2" class="form-control w-100 m-1">
                                                    <label for="fech_cualifi_2">Fecha de la cualificación</label>

                                                </div>

                                            </div>

                                            <!-- Carga de certificado -->
                                            <div class="col-md">
                                                
                                                <input type="file" name="doc_cualifi_2" id="doc_cualifi_2" class="custom-file-input" style="display:none">
                                                <label for="doc_cualifi_2" class="custom-file-label w-100 m-1">CARGAR CERTIFICADO</label>

                                            </div>
                                        
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- Boton para agregar segunda cualificacion -->
                                <button class="insertar_form mb-3 mt-3" id="insertar_form_cualifi" aria-label="agregar">
                                    <img src="../img/registro 1/icono de +.svg" alt="agregar">
                                </button>

                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">
                                            
                                            <button class="btn_atr" id="btn_atr_cualifi">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button class="btn_sig" id="btn_sig_cualifi">
                                                Siguiente
                                            </button>

                                        </div>

                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- REFERENCIA PERSONAL -->
                    <li class="ref_personal">
                        <div class="form">
                            <div class="sec_form container">

                                <h2>
                                    REFERENCIA PERSONAL
                                </h2>

                                <div class="container">

                                    <!-- PRIMERA REFERENCIA PERSONAL -->
                                    <div class="border-bottom mb-3 mt-3">

                                        <!-- Nombres y apellidos -->
                                        <div class="row g-2">

                                            <!-- Nombres -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="nombres_ref" id="nomb_ref" placeholder="Nombres" class="form-control w-100 m-1">
                                                    <label for="nomb_ref">Nombres</label>

                                                </div>

                                            </div>

                                            <!-- Apellidos -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="apellidos_ref" id="ape_ref" placeholder="Apellidos" class="form-control w-100 m-1">
                                                    <label for="ape_ref">Apellidos</label>

                                                </div>    

                                            </div>

                                        </div>

                                        <!-- Cargo y celular personal -->
                                        <div class="row g-2">

                                            <!-- Cargo -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="cargo_ref" id="car_ref" placeholder="Cargo" class="form-control w-100 m-1">
                                                    <label for="car_ref">Cargo de ocupa</label>
                                                            
                                                </div>
                                            
                                            </div>

                                            <!-- Celular personal -->
                                            <div class="col-md">

                                                <div class="form-floating">
                                                
                                                    <input type="number" name="celular_ref" id="cel_ref" placeholder="Celular" class="form-control w-100 m-1">
                                                    <label for="cel_ref">Celular personal</label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- SEGUNDA REFERENCIA PERSONAL -->
                                    <div class="border-bottom mb-3 mt-3" id="insertar_ref_per">

                                        <!-- Nombres y apellidos -->
                                        <div class="row g-2">

                                            <!-- Nombres -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="nombres_ref" id="nomb_ref_2" placeholder="Nombres" class="form-control w-100 m-1">
                                                    <label for="nomb_ref_2">Nombres</label>

                                                </div>

                                            </div>

                                            <!-- Apellidos -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="apellidos_ref" id="ape_ref_2" placeholder="Apellidos" class="form-control w-100 m-1">
                                                    <label for="ape_ref_2">Apellidos</label>

                                                </div>    

                                            </div>

                                        </div>

                                        <!-- Cargo y celular personal -->
                                        <div class="row g-2">

                                            <!-- Cargo -->
                                            <div class="col-md">

                                                <div class="form-floating">

                                                    <input type="text" name="cargo_ref" id="car_ref_2" placeholder="Cargo" class="form-control w-100 m-1">
                                                    <label for="car_ref_2">Cargo de ocupa</label>
                                                            
                                                </div>
                                            
                                            </div>

                                            <!-- Celular personal -->
                                            <div class="col-md">

                                                <div class="form-floating">
                                                
                                                    <input type="number" name="celular_ref" id="cel_ref_2" placeholder="Celular" class="form-control w-100 m-1">
                                                    <label for="cel_ref_2">Celular personal</label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- Boton para agregar segunda referencia personal -->
                                <button class="insertar_form mb-3 mt-3" id="insertar_ref_per_but" aria-label="agregar">
                                    <img src="../img/registro 1/icono de +.svg" alt="agregar">
                                </button>

                                <!-- Terminos y condiciones -->
                                <p>HE LEIDO Y ACEPTO LOS <a id="cont_termino"><b>TERMINOS Y CONDICIONES </b></a><input type="checkbox" name="termino" id="termino" aria-label="acepto terminos y condiciones"></p>
                                
                                <!-- Botones de control -->
                                <div>

                                    <div class="row g-2 mb-3 mt-3">

                                        <div class="col-md btn-center">
                                            
                                            <button class="btn_atr" id="btn_atr_fin">
                                                Atras
                                            </button>

                                        </div>

                                        <div class="col-md btn-center">

                                            <button name="registro" class="btn_fin" id="btn_env" disabled style="opacity: 0.5">
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
    
    <!-- VENTANA EMERGENTE PARA MOSTRAR ERRORES -->
    <div id="Cont_faltante" class="Cont_faltante">
        <div class="wind_msg" id="wind_msg">
            <div class="contWinMsg" id="contWinMsg">
                <div id="cont_msg" class="cont_msg"></div>
                <button id="acVenEm">ACEPTAR</button>
            </div>    
        </div>
    </div>

    <div id="Cont_carga" class="Cont_faltante">
        <div class="wind_msg" id="wind_carga">
            <div class="contWinMsg" id="contWinMsgcarga">
                <div id="cont_carga" class="cont_msg">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
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
            $("#municipio").prop("disabled", false);
            $("#departamento").change(function () {
                var selectedValue = $(this).val();

                $("#municipio").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);
                        var plantilla = '<option value="--">Municipio</option>';
                        datos.forEach(dato => {
                            plantilla += "<option value=" + dato.cod_mun + ">" + dato.municipio + "</option>";
                        });
                        console.log(plantilla);
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