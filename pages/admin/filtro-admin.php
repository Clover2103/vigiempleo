<?php

session_start();
if (!isset($_SESSION["nombre"])) {
    header("location: ./login-admin.php");
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
    <link rel="stylesheet" href="../../css/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/inicio_admin.css">
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
                <li><a id="btnCerrarSUN"><b>CERRAR SESION</b></a></li>
            </div>
        </nav>
    </header>

    <!-- Cuerpo y main -->
    <main class="cuerpo">
        <div class="cont_form container">

            <div class="row g-2 form-floating mb-5 mt-5">
                <select class="form-select col-6" id="admin_select" aria-label="Floating label select example">
                    <option value="0">-</option>
                    <option value="1">Consulta de inscritos natural</option>
                    <option value="2">Consulta de inscritos empresa</option>
                    <option selected value="3">Realizar filtro de personal</option>
                </select>
                <label for="admin_select">Seleccione la accion que quiere realizar</label>
            </div>

            <script>
            document.getElementById("admin_select").addEventListener("change", function() {
                if (this.value == "0") {
                    window.location.href = "./inicio_admin.php";
                } else if (this.value == "1") {
                    window.location.href = "./consulta_natural.php";
                } else if (this.value == "2") {
                    window.location.href = "./consulta_empresa.php";
                } else if (this.value == "3") {
                    window.location.href = "./filtro-admin.php";
                }
            })
        </script>

            <form class="form_int row g-3" id="filtro_aspirantes">

                <div class="form-floating col-md-4">
                    <select name="edad" id="cantidad" class="form-select m-1 w-100" aria-label="cantidad">
                        <option value="--">-</option>
                        <?php
                            // Genera opciones para las edades desde 18 hasta 70
                            for ($i = 1; $i <= 200; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <label for="cantidad">Cantidad <span>*</span></label>
                </div>

                <div class="form-floating  col-md-4">
                    <select type="text" id="cargo" class="form-select m-1 w-100">
                        <option value="--" selected>-</option>
                        <?php
                            foreach ($inf_car as $cargo) {
                                echo "<option value='" . $cargo ->  cod_cargo .  "'>" . $cargo -> cargo . "</option>";
                            }                                        
                        ?>
                    </select>
                    <label for="cargo">Cargo</label>
                </div>

                <div class="form-floating  col-md-4">
                    <select name="edad" id="edad_menor" class="form-select m-1 w-100" aria-label="edad">
                        <option value="--">-</option>
                        <?php
                            // Genera opciones para las edades desde 18 hasta 70
                            for ($i = 18; $i <= 70; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <label for="edad_menor">Edad minima <span>*</span></label>
                </div>
                
                <div class="form-floating  col-md-4">
                    <select name="edad" id="edad_mayor" class="form-select m-1 w-100" aria-label="edad-maxima">
                        <option value="--">-</option>
                        <?php
                            // Genera opciones para las edades desde 18 hasta 70
                            for ($i = 18; $i <= 70; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <label for="edad_mayor">Edad maxima <span>*</span></label>
                </div>
                    
                <div class="form-floating  col-md-4">
                    <select type="text" class="form-select m-1 w-100" id="departamento" aria-label="departamento">
                        <option value="--" selected>-</option>
                        <?php
                            foreach ($insert_ob as $departamento) {
                                echo "<option value='" . $departamento ->  cod_dep .  "'>" . $departamento -> departamento . "</option>";
                            }                                        
                        ?>
                    </select>
                    <label for="departamento">Departamento</label>
                </div>

                <div class="form-floating  col-md-4">
                    <select type="text" class="form-select m-1 w-100" id="municipios" aria-label="municipio">
                        <option value="--" selected>-</option>
                    </select>
                    <label for="municipios">Municipio</label>
                </div>

                <div class="form-floating  col-md-4">
                    <select type="text"  id="posee_lib" class="form-select m-1 w-100" aria-label="posee libreta">
                        <option value="--" selected>-</option> 
                        <option value="si">Si</option>
                    </select>
                    <label for="posee_lib">¿Con libreta militar?</label>
                </div>

                <div class="form-floating col-md-4">
                    <select type="text" id="posee_lic" class="form-select m-1 w-100" aria-label="posee licencia">
                        <option value="--" selected>-</option> 
                        <option value="si">Si</option>
                    </select>
                    <label for="posee_lic">¿Con licencia de conducción?</label>
                </div>

                <div class="form-floating col-md-4">
                    <select type="text" id="cate_lic" class="form-select m-1 w-100" aria-label="categoria licencia">
                        <option value="--" selected>-</option> 
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="B3">B3</option>
                        <option value="C1">C1</option>
                        <option value="C2">C2</option>
                        <option value="C3">C3</option>
                    </select>
                    <label for="cate_lic">Categoria de licencia</label>
                </div>

                <div class="form-floating col-md-4">
                    <select type="text" id="sexo" class="form-select m-1 w-100" aria-label="sexo">
                        <option value="--" selected>-</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Ambos">Ambos</option>
                    </select>
                    <label for="sexo">Sexo</label>
                </div>

                <div class="form-floating col-md-4">
                    <select type="text" id="ednia" class="form-select m-1 w-100" aria-label="etnia">
                        <option value="--" selected>-</option>
                        <option value="Indigena">Indigena</option>
                        <option value="Afrocolombiano">Afrocolombiano</option>
                        <option value="Raizal">Raizal</option>
                        <option value="Rom">Rom</option>
                        <option value="Ninguno">Ninguno</option>
                    </select>
                    <label for="ednia">Ednia</label>
                </div>

                <div class="form-floating col-md-4">
                    <input type="text"  id="tiempo_exp" class="form-control m-1 w-100" placeholder="Tiempo de experiencia (meses)">
                    <label for="tiempo_exp">Tiempo de experiencia (meses)</label>
                </div>

                <div class="form-floating col-md-4">
                    <select name="nivel_academico" id="nivel_academico" class="form-select m-1 w-100" aria-label="nivel academico">
                        <option value="--">-</option>
                        <?php
                            foreach ($inf_na as $nivel) {
                                echo "<option value='" . $nivel ->  cod_na .  "'>" . $nivel -> nivel_academico . "</option>";
                            }                                        
                        ?>
                    </select>
                    <label for="nivel_academico">Nivel academico minimo</label>
                </div>

                <div class="form-floating col-md-4">
                    <select type="text" id="cualificacion" class="form-select m-1 w-100" aria-label="cualificacion">
                        <option value="--">-</option>
                        <?php
                            foreach ($inf_cu as $cualificacion) {
                                echo "<option value='" . $cualificacion ->  cod_cuali .  "'>" . $cualificacion -> cualificacion . "</option>";
                            }                                        
                        ?>
                    </select>
                    <label for="cualificacion">Cualificacion</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    FILTRAR
                </button>
            </form>
        </div>
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

    <div id="contMsg" class="contMsg">
        <div class="contMsgCon" id="contMsgCon">
            <div class="contMsgConIn" id="contMsgConIn">
                <div id="contMsgConM" class="contMsgConM"></div>
                <button id="acVenEmConM">ACEPTAR</button>
                <button id="acVenEmConF">ACEPTAR</button>
            </div>    
        </div>
    </div>

    <iframe src="" id="oculto" frameborder="0"></iframe>

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
    <script src="../../js/main.js"></script>
    <script>
        $(document).ready(function () {
            $("#municipio").prop("disabled", false);
            $("#departamento").change(function () {
                var selectedValue = $(this).val();

                $("#municipio").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "../../obtener_datos/obtener_municipios.php",
                    data: { departamento: selectedValue },
                    success: function (municipios) {
                        var datos = JSON.parse(municipios);
                        var plantilla = '<option value="" selected>Municipio</option>';
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