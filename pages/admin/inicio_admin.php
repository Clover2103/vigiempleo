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

    <main class="w-100 cuerpo">
        <div class="container mt-4">
            <div class="form-container">
                <div class="form">
                    <form id="form_consulta_admin_uid">
                        <div class="row g-2">
                            <div class="form-floating col-md-7">
                                <input id="numeroDocumento" class="form-control" type="number" placeholder="NUMERO DE DOCUMENTO" >
                                <label for="numeroDocumento">NUMERO DE DOCUMENTO</label>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary">BUSCAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="resp_consulta" class="container mt-3">
        
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