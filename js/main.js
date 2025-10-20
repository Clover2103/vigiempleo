$(document).ready(function(){

    // ***************************************************************************************************** //
    // ****************************** VARIABLES Y CONSTANTES GLOBALES ************************************** //
    // ***************************************************************************************************** //
    let numeros = "0123456789";
    let letras="abcdefghyjklmnñopqrstuvwxyz";

    const section_ul = document.getElementById("section_ul");
    const section_ul_emp = document.getElementById("section_ul_emp");

    let insertar_form_for_aca = document.getElementById("insertar_form_for_aca");
    let insertar_ref_per_but = document.getElementById("insertar_ref_per_but");
    let cualifi__li = document.getElementById("cualifi__li");
    let insertar_form_cualifi = document.getElementById("insertar_form_cualifi");
    let insertar_form_capacita = document.getElementById("insertar_form_capacita");
    let insertar_otro = document.getElementById("insertar_otro");

    let ul_inf = document.getElementById("ul_inf");

    function validacion_num(texto){
        for(i=0; i<texto.length; i++){
            if (numeros.indexOf(texto.charAt(i),0)!=-1){
                return 1;
            }
        }
        return 0;
    }

    function validacion_letra(texto){
        texto = texto.toLowerCase();
        for(i=0; i<texto.length; i++){
            if (letras.indexOf(texto.charAt(i),0)!=-1){
                return 1;
            }
        }
        return 0;
    }

    function calcularEdad(fecha_nacimiento) {
        var hoy = new Date();
        var cumpleanos = new Date(fecha_nacimiento);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();
        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }
        return edad;
    }    

    function validarContrasena(contrasena) {
        const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+{}[\]:;<>,.?~\\/-]{8,}$/;
        return regex.test(contrasena);
    }

    function barajar(array) {
        var posicionActual = array.length;

        while (0 !== posicionActual) {
        const posicionAleatoria = Math.floor(Math.random() * posicionActual);
        posicionActual--;
        //"truco" para intercambiar los valores sin necesidad de una variable auxiliar
        [array[posicionActual], array[posicionAleatoria]] = [array[posicionAleatoria], array[posicionActual]];
        }
        return array;
    }

    function generarAleatorios(cantidad) {
        const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789".split("");
        barajar(caracteres);
        return caracteres.slice(0,cantidad).join("")
    }

    // ***************************************************************************************************** //
    // ************************************** BOTONES GLOBALES ********************************************* //
    // ***************************************************************************************************** //

    $('#btn_login').click(function ir_login () {
        window.location.href="../pages/login.php";
    });

    $('#btn_registro').click(function ir_registro() {
        window.location.href="../pages/registro.php";
    });
	
	$('#btn_login_re').click(function ir_login () {
        window.location.href="../pages/login.php";
    });

    $('#btn_registro_re').click(function ir_registro() {
        window.location.href="../pages/registro.php";
    });

    $('#btn_registrarse').click(function ir_registrarse () {
        location.href="../pages/registro.php";
    });

    $('#btn_empresa').click(function ir_reg_emp() {
        window.location.href="../pages/registro_empresa.php";
    });

    $('#btn_persona_natural').click(function ir_reg_natu() {
        window.location.href="../pages/registro_natural.php";
    });

    $('#btn_not_uno').click(function ir_not_uno() {
        window.location.href="../pages/noticia_uno.php";
    });

    $('#btn_not_uno_nat').click(function ir_not_uno() {
        window.location.href="../natural/noticia_uno.php";
    });

    $('#btn_not_uno_emp').click(function ir_not_uno() {
        window.location.href="../empresa/noticia_uno.php";
    });

    $('#btnCerrarSUN').click(function (e) {
        e.preventDefault();
        $('#contCerrar').show();
        $('#contCSi').click(function (e) { 
            e.preventDefault();
            window.location.href="../empresa/session_close.php";
        });
        $('#contCNo').click(function (e) { 
            e.preventDefault();
            $('#contCerrar').hide();
        });
    });

    $('#btnContIns').click(function ir_cont_ins() {
        window.location.href="../admin/inicio_admin.php";
    });
    
    $('#btnGenBD').click(function ir_gen_bd() {
        window.location.href="../admin/filtro-admin.php";
    });
		
	$('#btnCerrarSUN2').click(function (e) {
        e.preventDefault();
        $('#contCerrar').show();
        $('#contCSi').click(function (e) { 
            e.preventDefault();
            window.location.href="../empresa/session_close.php";
        });
        $('#contCNo').click(function (e) { 
            e.preventDefault();
            $('#contCerrar').hide();
        });
    });

    $('#btn_not_dos').click(function ir_not_dos() {
        window.location.href="../pages/noticia_dos.php";
    });

    $('#btn_not_dos_nat').click(function ir_not_dos() {
        window.location.href="../natural/noticia_dos.php";
    });

    $('#btn_not_dos_emp').click(function ir_not_dos() {
        window.location.href="../empresa/noticia_dos.php";
    });

    $('#btn_not_tres').click(function ir_not_tres() {
        window.location.href="../pages/noticia_tres.php";
    });

    $('#btn_not_tres_nat').click(function ir_not_tres() {
        window.location.href="../natural/noticia_tres.php";
    });

    $('#btn_not_tres_emp').click(function ir_not_tres() {
        window.location.href="../empresa/noticia_tres.php";
    });

    $('#btn_not_cuatro').click(function ir_not_tres() {
        window.location.href="../pages/noticia_cuatro.php";
    });

    $('#btn_not_cuatro_nat').click(function ir_not_tres() {
        window.location.href="../natural/noticia_cuatro.php";
    });

    $('#btn_not_cuatro_emp').click(function ir_not_tres() {
        window.location.href="../empresa/noticia_cuatro.php";
    });

    $('#btn_cogno').click(function ir_cogno () {
        window.location.href="https://cognoseguridad.com/";
    });

    $('#btn_conasegur').click(function ir_conasegur () {
        window.location.href="https://conasegur.org/";
    });

    $('#btn_club').click(function ir_club () {
        window.location.href="https://clubdetiroconasegur.com/";
    });

    $('#btn_ocp').click(function ir_ocp () {
        window.location.href="https://aiex.com.co/";
    });

    $('#btn_sst').click(function ir_sst () {
        window.location.href="https://aiex.co/";
    });

    $('#btn_vial').click(function ir_vial () {
        window.location.href="https://vialseguridad.com/";
    });

    $('#btn_funhumac').click(function ir_funhumac () {
        window.location.href="https://funhumac.org/";
    });

    $('#btn_acimad_c').click(function ir_acimad_c () {
        window.location.href="https://acimad.com/home-page/";
    });

    $('#btn_acimad_s').click(function ir_acimad_s () {
        window.location.href="https://acimad.com.co/index.php/inicio/";
    });

    $('#btn_bus_ofer_sliter').click(function () {
        window.location.href="../pages/vacantes.php?cargo=''&departamento=''&municipio=''";
    });

    $('#btn_bus_ofer_sliter_natural').click(function () {
        window.location.href="../natural/vacantes.php?cargo=''&departamento=''&municipio=''";
    });

    $('#cerHV').click(function (e) { 
        $('#contHV').hide();
    });

    $('#btn_hv_vigi_2').click(function () {
        $('#contHV').show();
    });

    $('#btn_hv_vigi').click(function () {

        $('#contHV').show();

        $('#HVida').empty();

        var url = "../../controlador/controlador_hv.php";
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                try {
                    if (response[0].type === 'pdf') {
                        const pdfIframe = document.createElement('iframe');
                        pdfIframe.src = "../" + response[0].file;
                        pdfIframe.width = '100%';
                        pdfIframe.height = '600px'; // Ajusta según sea necesario
                        pdfIframe.style.border = 'none';    
        
                        document.getElementById('HVida').appendChild(pdfIframe);
                    } else {
                        console.error('Tipo de contenido no admitido');
                    }
                } catch (e) {
                    console.error('Error al analizar la respuesta JSON:', e);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la llamada AJAX:', textStatus, errorThrown);
                console.log('Respuesta completa:', jqXHR.responseText);
            }
        });        
    });

    $('#dropdown-button').click(function (e) { 
        e.preventDefault();
        $('#dropdown-menu').toggle();
    });

    $('#dropdown-button_2').click(function (e) { 
        e.preventDefault();
        $('#dropdown-menu_2').toggle();
    });

    $('#btn_mas').click(function mostrar_des() {
        if ($('#container_des').hide()) {
            $('#container_des').show();
            $('#btn_cono_perf').html('mostrar menos');
        } else {
            $('#container_des').hide();
            $('#btn_cono_perf').html('mostrar mas');
        }
    });

    $('#btn_cono_aspi').click(function (e) {  
        e.preventDefault();
        if ($('#cont_perfil').hide()) {
            $('#cont_perfil').show();
            $('#btn_cono_aspi').html('mostar menos');
        } else {
            $('#cont_perfil').hide();
            $('#btn_cono_aspi').html('mostrar mas');
        }
    });

    $('#btn_bus_talento').click(function () {
        window.location.href="../pages/registro_empresa.php";
    });

    $('#btn_bus_empleo').click(function () {
        window.location.href="../pages/registro_natural.php";
    });

    // ***************************************************************************************************** //
    // ******************************** BOTONES INTERACION DE UL ******************************************* //
    // ***************************************************************************************************** //

    // INTERACCION CON EL BOTON SIGUIENTE DE LA SECCION DE INFORMACION GENERAL
    $('#btn_sig_inf_gen').click(async function (event) { 
        event.preventDefault();

        // Declaración variables
        let msg = "";

        // Data Form para llamar todos los elementos del DOM por ID
        var data_form = {
            primer_nombre :        $('#primer_nombre').val(),
            segundo_nombre :       $('#segundo_nombre').val(),
            primer_apellido :      $('#primer_apellido').val(),
            segundo_apellido :     $('#segundo_apellido').val(),
            tipo_de_documento :    $('#tipo_de_documento').val(),
            cedula_de_ciudadania : $('#cedula_de_ciudadania').val(),
            fecha_nacimiento :     $('#fecha_nacimiento').val(),
            sexo :                 $('#sexo').val(),
            ednia :                $('#ednia').val(),
            edad :                 $('#edad').val()
        };

        let cedula = data_form.cedula_de_ciudadania.trim();

        // Validamos que no esté vacío
        if (cedula === "") {
            msg += "- Ingrese un número de documento válido <br>";
        } else {
            try {
                let response = await fetch("../obtener_datos/natural/validar_cedula.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "cedula=" + encodeURIComponent(cedula)
                });

                let data = await response.json();

                if (data.existe) {
                    msg += "- El número de cédula ya se encuentra registrado <br>";
                }
            } catch (error) {
                console.error("Error:", error);
                msg += "- Error al validar la cédula <br>";
            }
        }

        // Validación de edad
        let edad = calcularEdad(data_form.fecha_nacimiento);
        let edadNumerica  = parseInt(data_form.edad);

        // Otras validaciones del sistema para la primera pestaña
        if (data_form.primer_nombre.length == 0) msg += "- Ingrese al menos un nombre <br>";
        if (data_form.primer_apellido.length == 0) msg += "- Ingrese al menos un apellido <br>";
        if (validacion_num(data_form.primer_nombre + data_form.segundo_nombre + data_form.primer_apellido + data_form.segundo_apellido)) msg += "- El nombre no puede tener números <br>";
        if (data_form.tipo_de_documento == "--") msg += "- Debe seleccionar un tipo de documento <br>";
        if (data_form.cedula_de_ciudadania.length > 16 || data_form.cedula_de_ciudadania.length == 0) msg += "- Ingrese un número de documento válido <br>";
        if (validacion_letra(data_form.cedula_de_ciudadania)) msg += "- El número de cédula no puede tener letras <br>";
        if (data_form.fecha_nacimiento.length == 0) msg += "- Ingrese una fecha de nacimiento <br>";
        if (edad < 18) msg += "- Usted es menor de edad <br>";
        if (edad !== edadNumerica && data_form.edad !== "--") msg += "- La fecha de nacimiento y la edad no coinciden <br>";
        if (data_form.sexo == "--") msg += "- Ingrese un tipo de sexo <br>";
        if (data_form.ednia == "--") msg += "- Ingrese un tipo de ednia <br>";
        if (data_form.edad == "--") msg += "- Ingrese su edad <br>";

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
            return; // detenemos aquí
        }

        // Interacción en el sistema en caso de no tener errores
        section_ul.style.marginLeft = "-100%";
        section_ul.style.transition = "1.5s";
        getValueInputNombre();
    });


    // Funcion para mostrar nombre completo en contenedor azul del formulario debajo de la foto
    function getValueInputNombre () {
        let primer_nombre = document.getElementById("primer_nombre").value;
        let segundo_nombre = document.getElementById("segundo_nombre").value;
        let primer_apellido = document.getElementById("primer_apellido").value;
        let segundo_apellido = document.getElementById("segundo_apellido").value;
        document.getElementById("valueInputName").innerHTML = primer_nombre + " " + segundo_nombre + " " + primer_apellido + " " +  segundo_apellido;
    }
    

    // INTERACCION CON EL BOTON ATRAS DE LA SECCION DE INFORMACION DE CONTACTOGENERAL //
    $('#btn_atr_cont').click(function (event) {
        event.preventDefault();
        section_ul.style.marginLeft = "0%";
        section_ul.style.transition = "1.5s";
    });

    // INTERACCION CON EL BOTON SIGUIENTE DE LA SECCION DE INFORMACION DE CONTACTOGENERAL //
    $('#btn_sig_cont').click(function (event) {
        event.preventDefault()

        // Declaracion de variables
        let msg = "";

        // Data Form para llamar todos los elementos del DOM por ID
        var data_form = {
            departamento :              $('#departamento').val(),
            municipios :                $('#municipios').val(),
            direccion :                 $('#direccion').val(),
            celular_cont :              $('#celular_cont').val(),
            correo :                    $('#correo').val(),
            correo_conf :               $('#correo_conf').val(),
            contrasena :                $('#contrasena').val(),
            conf_contrasena :           $('#conf_contrasena').val(),
            posee_lib :                 $('#posee_lib').val(),
            numero_lib :                $('#numero_lib').val(),
            posee_lic :                 $('#posee_lic').val(),
            numero_lic :                $('#numero_lic').val(),
            cate_lic :                  $('#cate_lic').val(),
            contacto_area :             $('#contacto_area').val()
        };

        console.log(data_form);
        

        // Validaciones del sistema para la segunda pestaña de informacion de contacto
        data_form.direccion.length == 0 ? msg += "- Debe ingresar una direccion de recidencia <br>" : "";
        (data_form.celular_cont.length !== 10 || data_form.celular_cont < 3000000000 || data_form.celular_cont > 3999999999 ) ? msg += "- Debe ingresar un numero celular valido que comience por 3 y con 10 digitos <br>" : "";
        validacion_letra(data_form.celular_cont) ? msg += "- El numero de celula no puede tener letras <br>" : "";
        data_form.departamento == "--" ? msg += "- Ingrese el departamento donde reside <br>" : "";
        data_form.municipios == "--" ? msg += "- Ingrese el municipios donde reside <br>" : "";
        data_form.correo == null ? msg += "- Debe ingresar un correo electronico <br>" : "";
        data_form.correo !== data_form.correo_conf ? msg += "- El correo que esta ingresando no coinciden <br>" : "" ;
        !validarContrasena(data_form.contrasena) ? msg += "- Su contraseña debe contar con minusculas, mayusculos, numero y caracteres especiales <br>" : "";
        data_form.contrasena !== data_form.conf_contrasena ? msg += "- Las contraseñas deben ser iguales <br>" : "";
        data_form.posee_lib == "--" ? msg += "- Debe ingresar si posee libreta o no <br>" : "";
        (data_form.numero_lib == "" && data_form.posee_lib !== "no" && data_form.posee_lib !== "--") ? msg += "- Ingrese un numero de libreta <br>" : "";
        validacion_letra(data_form.numero_lib) ? msg += "- La libreta no puede tener numeros <br>" : "";
        data_form.posee_lic == "--" ? msg += "- Debe ingresar si posee licencia o no <br>" : "";
        (data_form.numero_lic == "" && data_form.posee_lic !== "no" && data_form.posee_lic !== "--") ? msg += "- Ingrese un numero de licencia <br>" : "";
        ( data_form.posee_lic !== "no" && data_form.posee_lic !== "--" && data_form.cate_lic == "--") ? msg += "- debe ingresar categoria de licencia de conducción <br>" : "";
        (data_form.contacto_area.length == 0) ? msg += "- Ingrese una descripción suya <br>" : "";

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            section_ul.style.marginLeft = "-200%";
            section_ul.style.transition = "1.5s";
            getValueInput();
        }

    });

    // Funcion para mostrar la descripcion en la seccion azul izquierda debajo de la foto
    function getValueInput () {
        let inputValue = document.getElementById("contacto_area").value; 
        document.getElementById("valueInput").innerHTML = inputValue; 
    }


    // INTERACCION CON EL BOTON ATRAS DE LA SECCION DE EXPERIENCIAS LABORALES //
    $('#btn_atr_exp_lab').click(function (e) {
        e.preventDefault(); 
        section_ul.style.marginLeft = "-100%";
        section_ul.style.transition = "1.5s";
    });

    // INTERACCION CON EL BOTON SIGUIENTE DE LA SECCION DE EXPERIENCIAS LABORALES //
    $('#btn_sig_exp_lab').click(function (e) {
        e.preventDefault(); 

        // Declaracion de variables
        let msg = "";

        // Data Form para llamar todos los elementos del DOM por ID
        var data_form = {

            nombre_empresa :            $('#nombre_empresa').val(),
            cargo :                     $('#cargo').val(),
            cargo_dese :                $('#cargo_dese').val(),
            tiempo_ingreso_exp :        $('#tiempo_ingreso_exp').val(),
            tiempo_salida_1 :           $('#tiempo_salida_1').val(),
            sig_trab:                   $('#sig_trab').val(),
            jefe_inmediato :            $('#jefe_inmediato').val(),
            celular_exp :               $('#celular_exp').val(),
            // compro_laboral :            $('#compro_laboral').val(),

            nombre_empresa_2 :          $('#nombre_empresa_2').val(),
            cargo_2 :                   $('#cargo_2').val(),
            cargo_dese_2 :              $('#cargo_dese_2').val(),
            tiempo_ingreso_exp_2 :      $('#tiempo_ingreso_exp_2').val(),
            tiempo_salida_2 :           $('#tiempo_salida_2').val(),
            sig_trab_2:                 $('#sig_trab_2').val(),
            jefe_inmediato_2 :          $('#jefe_inmediato_2').val(),
            celular_exp_2 :             $('#celular_exp_2').val(),
            // compro_laboral_2 :          $('#compro_laboral_2').val()

        };

        console.log(data_form);

        // Se agrupan por secciones de las experiencias laborales para trabajar las validaciones por grupos
        if (data_form.sig_trab == "si") {
            // var primera_ref_lab = data_form.nombre_empresa + data_form.cargo + data_form.tiempo_ingreso_exp + data_form.jefe_inmediato + data_form.celular_exp + data_form.compro_laboral;
            var primera_ref_lab = data_form.nombre_empresa + data_form.cargo + data_form.tiempo_ingreso_exp + data_form.jefe_inmediato + data_form.celular_exp ;
        } else {
            // var primera_ref_lab = data_form.nombre_empresa + data_form.cargo + data_form.tiempo_ingreso_exp + data_form.jefe_inmediato + data_form.celular_exp + data_form.compro_laboral;
            var primera_ref_lab = data_form.nombre_empresa + data_form.cargo + data_form.tiempo_ingreso_exp + data_form.tiempo_salida_1 + data_form.jefe_inmediato + data_form.celular_exp;
        }

        if (data_form.sig_trab_2 == "si") {
            // var segundo_ref_lab = data_form.nombre_empresa_2 + data_form.cargo_2 + data_form.tiempo_ingreso_exp_2 + data_form.jefe_inmediato_2 + data_form.celular_exp_2 + data_form.compro_laboral_2;    
            var segundo_ref_lab = data_form.nombre_empresa_2 + data_form.cargo_2 + data_form.tiempo_ingreso_exp_2 + data_form.jefe_inmediato_2 + data_form.celular_exp_2;    
        } else {
            // var segundo_ref_lab = data_form.nombre_empresa_2 + data_form.cargo_2 + data_form.tiempo_ingreso_exp_2 + data_form.tiempo_salida_2 + data_form.jefe_inmediato_2 + data_form.celular_exp_2 + data_form.compro_laboral_2;
            var segundo_ref_lab = data_form.nombre_empresa_2 + data_form.cargo_2 + data_form.tiempo_ingreso_exp_2 + data_form.tiempo_salida_2 + data_form.jefe_inmediato_2 + data_form.celular_exp_2;
        }

        // Validacion de formacion academica
        // if (data_form.sig_trab !== "--" && ((data_form.nombre_empresa == "") && (data_form.cargo == "--") && (data_form.tiempo_ingreso_exp == "") && (data_form.jefe_inmediato == "") && (data_form.celular_exp == "") && (data_form.compro_laboral == ""))) {
        if (data_form.sig_trab !== "--" && ((data_form.nombre_empresa == "") && (data_form.cargo == "--") && (data_form.tiempo_ingreso_exp == "") && (data_form.jefe_inmediato == "") && (data_form.celular_exp == ""))) {
            (data_form.nombre_empresa == "" || data_form.cargo == "--" || data_form.tiempo_ingreso_exp == "" || data_form.jefe_inmediato == "" || data_form.celular_exp == "") ? msg += "PARA LA PRIMERA REFERENCIA LABORAL: <br>": "";
            data_form.nombre_empresa == "" ? msg += "- Ingrese el nombre de la empresa <br>" : "";
            data_form.cargo == "--" ? msg += "- Indique el cargo desempeñado <br>" : "";
            data_form.tiempo_ingreso_exp == "" ? msg += "- Ingrese fecha de ingreso laboral <br>" : "" ;
            data_form.jefe_inmediato == "" ? msg += "- Ingrese el nombre de su jefe inmediato <br>" : "" ;
            data_form.celular_exp == "" ? msg += "- Ingrese telefono de la empresa o celular de jefe inmediato <br>" : "" ;
            // data_form.compro_laboral == "" ? msg += "- Por favor ingrese el <b>certificado laboral</b> <br>" : "" ;
        }

        // if (data_form.sig_trab_2 !== "--" && ((data_form.nombre_empresa_2 == "") && (data_form.cargo_2 == "--") && (data_form.tiempo_ingreso_exp_2 == "") && (data_form.jefe_inmediato_2 == "") && (data_form.celular_exp_2 == "") && (data_form.compro_laboral_2 == ""))) {
        if (data_form.sig_trab_2 !== "--" && ((data_form.nombre_empresa_2 == "") && (data_form.cargo_2 == "--") && (data_form.tiempo_ingreso_exp_2 == "") && (data_form.jefe_inmediato_2 == "") && (data_form.celular_exp_2 == ""))) {
            (data_form.nombre_empresa_2 == "" || data_form.cargo_2 == "--" || data_form.tiempo_ingreso_exp_2 == "" || data_form.jefe_inmediato_2 == "" || data_form.celular_exp_2 == "") ? msg += "PARA LA SEGUNDA REFERENCIA LABORAL: <br>": "";
            data_form.nombre_empresa_2 == "" ? msg += "- Agregue el nombre de la empresa<br>" : "";
            data_form.cargo_2 == "--" ? msg += "- Indique el cargo desempeñado<br>" : "";
            data_form.tiempo_ingreso_exp_2 == "" ? msg += "- Ingrese fecha de ingreso laboral<br>" : "" ;
            data_form.jefe_inmediato_2 == "" ? msg += "- Ingrese el nombre de su jefe inmediato<br>" : "" ;
            data_form.celular_exp_2 == "" ? msg += "- Ingrese telefono de la empresa o celular de jefe inmediato<br>" : "" ;
            // data_form.compro_laboral_2 == "" ? msg += "- Por favor ingrese el <b>certificado laboral</b> en la segunda referencia laboral <br>" : "" ;
        }

        if (primera_ref_lab !== "--") {
            if (data_form.sig_trab == "si") {
                (data_form.nombre_empresa == "" || data_form.cargo == "--" || data_form.tiempo_ingreso_exp == "" || data_form.jefe_inmediato == "" || data_form.celular_exp == "" || (data_form.cargo == "06" && data_form.cargo_dese == "")) ? msg += "PARA LA PRIMERA REFERENCIA LABORAL: <br>" : "";
                data_form.nombre_empresa == "" ? msg += "- Agregue el nombre de la empresa<br>" : "";
                data_form.cargo == "--" ? msg += "- Indique el cargo desempeñado<br>" : "";
                data_form.cargo == "06" && data_form.cargo_dese == "" ? msg += "- Ingrese el cargo que desempeño<br>" : "";
                data_form.tiempo_ingreso_exp == "" ? msg += "- Ingrese fecha de ingreso laboral<br>" : "" ;
                data_form.jefe_inmediato == "" ? msg += "- Ingrese por favor el nombre de su jefe inmediato<br>" : "" ;
                data_form.celular_exp == "" ? msg += "- Ingrese telefono de la empresa o celular de jefe inmediato<br>" : "" ;
                // data_form.compro_laboral == "" ? msg += "- Por favor ingrese el <b>certificado laboral</b> <br>" : "" ;
            } else {
                (data_form.nombre_empresa == "" || data_form.cargo == "--" || data_form.tiempo_ingreso_exp == "" || data_form.tiempo_salida_1 == "" || data_form.jefe_inmediato == "" || data_form.celular_exp == "" || (data_form.cargo == "06" && data_form.cargo_dese == "")) ? msg += "PARA LA PRIMERA REFERENCIA LABORAL: <br>" : "";
                data_form.nombre_empresa == "" ? msg += "- Agregue el nombre de la empresa <br>" : "";
                data_form.cargo == "--" ? msg += "- Indique el cargo desempeñado <br>" : "";
                data_form.cargo == "06" && data_form.cargo_dese == "" ? msg += "- Ingrese el cargo que desempeño<br>" : "";
                data_form.tiempo_ingreso_exp == "" ? msg += "- Ingrese fecha de ingreso laboral<br>" : "" ;
                data_form.tiempo_salida_1 == "" && data_form.sig_trab == "no" ? msg += "- Ingrese fecha de finalización <br>" : "" ;
                data_form.jefe_inmediato == "" ? msg += "- Ingrese por favor el nombre de su jefe inmediato<br>" : "" ;
                data_form.celular_exp == "" ? msg += "- Ingrese telefono de la empresa o celular de jefe inmediato<br>" : "" ;
                // data_form.compro_laboral == "" ? msg += "- Por favor ingrese el <b>certificado laboral</b> <br>" : "" ;
                (data_form.tiempo_ingreso_exp > data_form.tiempo_salida_1) ? msg += "- El tiempo de ingreso debe ser menos al tiempo salida de la primera referencia laboral<br>" : "";
            }
        }

        if (segundo_ref_lab !== "--") {
            if (data_form.sig_trab_2 == "si") {
                (data_form.nombre_empresa_2 == "" || data_form.cargo_2 == "--" || data_form.tiempo_ingreso_exp_2 == "" || data_form.jefe_inmediato_2 == "" || data_form.celular_exp_2 == "" || (data_form.cargo_2 == "06" && data_form.cargo_dese_2 == "")) ? msg += "PARA LA SEGUNDA REFERENCIA LABORAL: <br>" : "";
                data_form.nombre_empresa_2 == "" ? msg += "- Agregue el nombre de la empresa<br>" : "";
                data_form.cargo_2 == "--" ? msg += "- Indique el cargo desempeñado<br>" : "";
                data_form.cargo_2 == "06" && data_form.cargo_dese_2 == "" ? msg += "- Ingrese el cargo que desempeño<br>" : "";
                data_form.tiempo_ingreso_exp_2 == "" ? msg += "- Ingrese fecha de ingreso laboral<br>" : "" ;
                data_form.jefe_inmediato_2 == "" ? msg += "- Ingrese por favor el nombre de su jefe inmediato<br>" : "" ;
                data_form.celular_exp_2 == "" ? msg += "- Ingrese telefono de la empresa o celular de jefe inmediato<br>" : "" ;
                // data_form.compro_laboral_2 == "" ? msg += "- Por favor ingrese el <b>certificado laboral</b> en la segunda referencia laboral <br>" : "" ;
            } else {
                (data_form.nombre_empresa_2 == "" || data_form.cargo_2 == "--" || data_form.tiempo_ingreso_exp_2 == "" || data_form.jefe_inmediato_2 == "" || data_form.celular_exp_2 == "" || (data_form.cargo_2 == "06" && data_form.cargo_dese_2 == "")) ? msg += "PARA LA SEGUNDA REFERENCIA LABORAL: <br>" : "";
                data_form.nombre_empresa_2 == "" ? msg += "- Agregue el nombre de la empresa<br>" : "";
                data_form.cargo_2 == "--" ? msg += "- Indique el cargo desempeñado<br>" : "";
                data_form.cargo_2 == "06" && data_form.cargo_dese_2 == "" ? msg += "- Ingrese el cargo que desempeño<br>" : "";
                data_form.tiempo_ingreso_exp_2 == "" ? msg += "- Ingrese fecha de ingreso laboral en la segunda referencia laboral <br>" : "" ;
                data_form.tiempo_salida_2 == "" && data_form.sig_trab_2 == "no" ? msg += "- Ingrese fecha de finalización<br>" : "" ;
                data_form.jefe_inmediato_2 == "" ? msg += "- Ingrese por favor el nombre de su jefe inmediato<br>" : "" ;
                data_form.celular_exp_2 == "" ? msg += "- Ingrese telefono de la empresa o celular de jefe inmediato<br>" : "" ;
                // data_form.compro_laboral_2 == "" ? msg += "- Por favor ingrese el <b>certificado laboral</b> en la segunda referencia laboral <br>" : "" ;
                (data_form.tiempo_ingreso_exp_2 > data_form.tiempo_salida_2) ? msg += "- El tiempo de ingreso debe ser menos al tiempo salida<br>" : "";
            }
        }

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            section_ul.style.marginLeft = "-300%";
            section_ul.style.transition = "1.5s";
        }

    });

    $('#tiempo_salida_1').prop('disabled', true);
    $('#tiempo_salida_2').prop('disabled', true);

    // Cuando cambia la fecha de inicio para evitar errores de mayores y menores fechas
    $('#tiempo_ingreso_exp').change(function() {
        var fechaInicio = $(this).val();
        $('#tiempo_salida_1').prop('disabled', false);
        $('#tiempo_salida_1').attr('min', fechaInicio);
    });

    // Cuando cambia la fecha de inicio para evitar errores de mayores y menores fechas
    $('#tiempo_ingreso_exp_2').change(function() {
        var fechaInicio = $(this).val();
        $('#tiempo_salida_2').prop('disabled', false);
        $('#tiempo_salida_2').attr('min', fechaInicio);
    });


    // INTERACCION CON EL BOTON ATRAS DE LA SECCION DE FORMACIÓN ACADEMICA //
    $('#btn_atr_form_aca').click(function (e) {
        e.preventDefault(); 
        section_ul.style.marginLeft = "-200%";
        section_ul.style.transition = "1.5s";
    });
    
    // INTERACCION CON EL BOTON SIGUIENTE DE LA SECCION DE FORMACION ACADEMICA //
    $('#btn_sig_for_aca').click(function (e){
        e.preventDefault();

        // Declaracion de variables
        let msg = "";

        // Se establece el data form para las validaciones posteriores
        var data_form = {

            nombre_instituto :          $('#nombre_instituto').val(),
            nivel_academico :           $('#nivel_academico').val(),
            titulo_op :                 $('#titulo_op').val(),
            culm_aca :                  $('#culm_aca').val(),
            tiempo_fin_1 :              $('#tiempo_fin_1').val(),
            sigo_estu :                 $('#sigo_estu').prop('checked'),
            // comp_est_for :              $('#comp_est_for').val(),
            
            nombre_instituto_2 :        $('#nombre_instituto_2').val(),
            nivel_academico_2 :         $('#nivel_academico_2').val(),
            titulo_op_2 :               $('#titulo_op_2').val(),
            culm_aca_2 :                $('#culm_aca_2').val(),
            tiempo_fin_2 :              $('#tiempo_fin_2').val(),
            sigo_estu_2 :               $('#sigo_estu_2').prop('checked'),
            // comp_est_for_2 :            $('#comp_est_for_2').val()
        };

        console.log(data_form);

        // Se agrupan por secciones de las formaciones academicas para trabajar las validaciones por grupos
        if (data_form.culm_aca == "si") {
            // var primera_for_aca = data_form.nombre_instituto + data_form.nivel_academico + data_form.titulo_op + data_form.comp_est_for + data_form.tiempo_fin_1;
            var primera_for_aca = data_form.nombre_instituto + data_form.nivel_academico + data_form.titulo_op + data_form.tiempo_fin_1;
        } else {
            // var primera_for_aca = data_form.nombre_instituto + data_form.nivel_academico + data_form.titulo_op + data_form.comp_est_for;
            var primera_for_aca = data_form.nombre_instituto + data_form.nivel_academico + data_form.titulo_op;
        }

        if (data_form.culm_aca_2 == "si") {
            // var segundo_for_aca = data_form.nombre_instituto_2 + data_form.nivel_academico_2 + data_form.titulo_op_2 + data_form.comp_est_for_2 + data_form.tiempo_fin_2 ;    
            var segundo_for_aca = data_form.nombre_instituto_2 + data_form.nivel_academico_2 + data_form.titulo_op_2 + data_form.tiempo_fin_2 ;    
        } else {
            // var segundo_for_aca = data_form.nombre_instituto_2 + data_form.nivel_academico_2 + data_form.titulo_op_2 + data_form.comp_est_for_2;
            var segundo_for_aca = data_form.nombre_instituto_2 + data_form.nivel_academico_2 + data_form.titulo_op_2;
        }

        // Validacion de formacion academica
        // if (data_form.culm_aca !== "--" && ((data_form.nombre_instituto == "") && (data_form.nivel_academico == "--") && (data_form.titulo_op == "") && (data_form.comp_est_for == ""))) {
        if (data_form.culm_aca !== "--" && ((data_form.nombre_instituto == "") && (data_form.nivel_academico == "--") && (data_form.titulo_op == ""))) {
            (data_form.nombre_instituto == "" || data_form.nivel_academico == "--" || data_form.titulo_op == "") ? msg += "PARA LA PRIMERA FORMACION ACADEMICA DEBE INGRESAR:<br>": "";
            data_form.nombre_instituto == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
            data_form.nivel_academico == "--" ? msg += "- Ingresar el nivel academico<br>" : "";
            data_form.titulo_op == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
            // data_form.comp_est_for == "" ? msg += "- Debe anexar el <b>certificado optenido</b> de la primera formacion academica <br>" : "";
        }

        // if (data_form.culm_aca_2 !== "--" && ((data_form.nombre_instituto_2 == "") && (data_form.nivel_academico_2 == "--") && (data_form.titulo_op_2 == "") && (data_form.comp_est_for_2 == ""))) {
        if (data_form.culm_aca_2 !== "--" && ((data_form.nombre_instituto_2 == "") && (data_form.nivel_academico_2 == "--") && (data_form.titulo_op_2 == ""))) {
            (data_form.nombre_instituto_2 == "" || data_form.nivel_academico_2 == "--" || data_form.titulo_op_2 == "") ? msg += "PARA LA SEGUNDA FORMACION ACADEMICA DEBE INGRESAR:<br>" : "";
            data_form.nombre_instituto_2 == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
            data_form.nivel_academico_2 == "--" ? msg += "- Ingresar el nivel academico<br>" : "";
            data_form.titulo_op_2 == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
            // data_form.comp_est_for_2 == "" ? msg += "- Debe anexar el <b>certificado optenido</b> de la segunda formacion academica <br>" : "";
        }

        if (primera_for_aca !== "--") {
            if (data_form.culm_aca == "si") {
                (data_form.nombre_instituto == "" || data_form.nivel_academico == "--" || data_form.titulo_op == "" || data_form.tiempo_fin_1 == "") ? msg += "PARA LA PRIMERA FORMACION ACADEMICA DEBE INGRESAR:<br>" : "";
                data_form.nombre_instituto == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
                data_form.nivel_academico == "--" ? msg += "- Ingresar el nivel academico<br>" : "";
                data_form.titulo_op == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
                // data_form.comp_est_for == "" ? msg += "- Debe anexar el <b>certificado optenido</b> de la primera formacion academica <br>" : "";
                data_form.tiempo_fin_1 == "" ? msg += "- Ingresar la fecha de finalizacion<br>" : "";
            } else {
                (data_form.nombre_instituto == "" || data_form.nivel_academico == "--" || data_form.titulo_op == "" || data_form.culm_aca == "--") ? msg += "PARA LA PRIMERA FORMACION ACADEMICA DEBE INGRESAR:<br>" : "";
                data_form.nombre_instituto == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
                data_form.nivel_academico == "--" ? msg += "- Ingresar el nivel academico<br>" : "";
                data_form.titulo_op == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
                // data_form.comp_est_for == "" ? msg += "- Debe anexar el <b>certificado optenido</b> de la primera formacion academica <br>" : "";
                data_form.culm_aca == "--" ? msg += "- Indicar si termino o no la educacion<br>" : "";
            }
        }

        if (segundo_for_aca !== "--") {
            if (data_form.culm_aca_2 == "si") {
                (data_form.nombre_instituto_2 == "" || data_form.nivel_academico_2 == "--" || data_form.titulo_op_2 == "" || data_form.tiempo_fin_2 == "" || data_form.tiempo_fin_2 == "") ? msg += "PARA LA SEGUNDA FORMACION ACADEMICA DEBE INGRESAR:<br>" : "";
                data_form.nombre_instituto_2 == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
                data_form.nivel_academico_2 == "--" ? msg += "- Ingresar el nivel academico<br>" : "";
                data_form.titulo_op_2 == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
                // data_form.comp_est_for_2 == "" ? msg += "- Debe anexar el <b>certificado optenido</b> de la segunda formacion academica <br>" : "";
                data_form.tiempo_fin_2 == "" ? msg += "- Ingresar la fecha de finalizacion<br>" : "";
            } else {
                (data_form.nombre_instituto_2 == "" || data_form.nivel_academico_2 == "--" || data_form.titulo_op_2 == "" || data_form.culm_aca_2 == "--") ? msg += "PARA LA SEGUNDA FORMACION ACADEMICA DEBE INGRESAR:<br>" : "";
                data_form.nombre_instituto_2 == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
                data_form.nivel_academico_2 == "--" ? msg += "- Ingresar el nivel academico<br>" : "";
                data_form.titulo_op_2 == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
                // data_form.comp_est_for_2 == "" ? msg += "- Debe anexar el <b>certificado optenido</b> de la segunda formacion academica <br>" : "";
                data_form.culm_aca_2 == "--" ? msg += "- Indicar si termino o no la educacion<br>" : "";
            }
        }

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            section_ul.style.marginLeft = "-400%";
            section_ul.style.transition = "1.5s";
        }        
    });


    // INTERACCION CON EL BOTON ATRAS DE LA SECCION DE OTROS ESTUDIOS CERTIFICABLES //
    $('#btn_atr_otro').click(function (e) {
        e.preventDefault(); 
        section_ul.style.marginLeft = "-300%";
        section_ul.style.transition = "1.5s";
    });

    // INTERACCION CON EL BOTON SIGUIENTE DE LA SECCION DE OTROS ESTUDIOS CERTIFICABLES //
    $('#btn_sig_otro').click(function (e) {
        e.preventDefault(); 

        // Declaracion de variables
        let msg = "";

        // Se establece el data form para las validaciones posteriores
        var data_form = {

            nombre_instituto_otro :     $('#nombre_instituto_otro').val(),
            titulo_op_otro :            $('#titulo_op_otro').val(),
            tiempo_fin_otro_1 :         $('#tiempo_fin_otro_1').val(),
            // comp_otro :                 $('#comp_otro').val(),

            nombre_instituto_otro_2 :   $('#nombre_instituto_otro_2').val(),
            titulo_op_otro_2 :          $('#titulo_op_otro_2').val(),
            tiempo_fin_otro_2 :         $('#tiempo_fin_otro_2').val(),
            // comp_otro_2 :               $('#comp_otro_2').val()

        };

        console.log(data_form);

        // Se agrupan por secciones de otras formaciones certificables para trabajar las validaciones por grupos
        // var primer_est_ex = data_form.nombre_instituto_otro + data_form.titulo_op_otro +  data_form.tiempo_fin_otro_1 + data_form.comp_otro;
        var primer_est_ex = data_form.nombre_instituto_otro + data_form.titulo_op_otro +  data_form.tiempo_fin_otro_1;
        // var segunda_est_ex = data_form.nombre_instituto_otro_2 + data_form.titulo_op_otro_2 + data_form.tiempo_fin_otro_2 + data_form.comp_otro_2;
        var segunda_est_ex = data_form.nombre_instituto_otro_2 + data_form.titulo_op_otro_2 + data_form.tiempo_fin_otro_2;

        // Validacion de otros estudios
        if (primer_est_ex !== "") {
            (data_form.nombre_instituto_otro == "" || data_form.titulo_op_otro == "" || data_form.tiempo_fin_otro_1 == "") ? msg += "PARA LA PRIMERA SECCION DE ESTUDIOS FORMALES DEBE INGRESAR:<br>" : "";
            data_form.nombre_instituto_otro == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
            data_form.titulo_op_otro == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
            data_form.tiempo_fin_otro_1 == "" ? msg += "- Ingresar la fecha de finalización<br>" : "";
            // data_form.comp_otro == "" ? msg += "- Debe anexar el <b>certificado</b> de la primera seccion <br>" : "";
        }

        if (segunda_est_ex !== "") {
            (data_form.nombre_instituto_otro_2 == "" || data_form.titulo_op_otro_2 == "" || data_form.tiempo_fin_otro_2 == "") ? msg += "PARA LA SEGUNDA SECCION DE ESTUDIOS FORMALES DEBE INGRESAR:<br>" : "";
            data_form.nombre_instituto_otro_2 == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
            data_form.titulo_op_otro_2 == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
            data_form.tiempo_fin_otro_2 == "" ? msg += "- Ingresar la fecha de finalización<br>" : "";
            // data_form.comp_otro_2 == "" ? msg += "- Debe anexar el <b>certificado</b> de la segunda seccion <br>" : "";
        }

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            section_ul.style.marginLeft = "-500%";
            section_ul.style.transition = "1.5s";
        }
        
    });


    // INTERACCION CON EL BOTON ATRAS DE LA SECCION DE CAPACITACIONES //
    $('#btn_atr_capacita').click(function (e) {
        e.preventDefault(); 
        section_ul.style.marginLeft = "-400%";
        section_ul.style.transition = "1.5s";
    });

    // INTERACCION CON EL BOTON SI DE LA SECCION DE CAPACITACIONES PARA SABER SI TIENE CUALIFICACIONES //
    $('#cualifi__button_si').click(function cualifi_si(e){
        e.preventDefault();

        // Declaracion de variables
        let msg = "";

        // Se establece el data form para las validaciones posteriores
        var data_form = {

            lug_capaci :                $('#lug_capaci').val(),
            lug_capacita :              $('#lug_capacita').val(),
            fech_capacita :             $('#fech_capacita').val(),
            doc_capacita :              $('#doc_capacita').val(),

            lug_capaci_2 :              $('#lug_capaci_2').val(),
            lug_capacita_2 :            $('#lug_capacita_2').val(),
            fech_capacita_2 :           $('#fech_capacita_2').val(),
            // doc_capacita_2 :            $('#doc_capacita_2').val()

        };

        console.log(data_form);

        // Calcular el tiempo que lleva el cartificado vigente
        let fec_cap_1 =  calcularEdad(data_form.fech_capacita);

        // Validacion de otros estudios
        data_form.lug_capaci == "" ? msg += "- Ingresar el nombre del instituto de la primera seccion <br>" : "";
        data_form.lug_capacita == "" ? msg += "- Ingresar el titulo optenido de la primera seccion <br>" : "";
        data_form.fech_capacita == "" ? msg += "- Ingresar la fecha de finalización de la primera seccion <br>" : "";
        data_form.doc_capacita == "" ? msg += "- Debe anexar el certificado de la primera seccion <br>" : "";
        fec_cap_1 > 0 ? msg += "- Su certificado de capacitacion de la primera seccion ya expiro " : "";

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            section_ul.style.width = "800%";
            cualifi__li.style.display = "block";
            section_ul.style.marginLeft = "-600%";
            section_ul.style.transition = "1.5s"; 
        }

    });

    // INTERACCION CON EL BOTON SI DE LA SECCION DE CAPACITACIONES PARA SABER NO TIENE CUALIFICACIONES //
    $('#cualifi__button_no').click(function(e){
        e.preventDefault();

        // Declaracion de variables
        let msg = "";

        // Se establece el data form para las validaciones posteriores
        var data_form = {

            lug_capaci :                $('#lug_capaci').val(),
            lug_capacita :              $('#lug_capacita').val(),
            fech_capacita :             $('#fech_capacita').val(),
            doc_capacita :              $('#doc_capacita').val(),

            lug_capaci_2 :              $('#lug_capaci_2').val(),
            lug_capacita_2 :            $('#lug_capacita_2').val(),
            fech_capacita_2 :           $('#fech_capacita_2').val(),
            doc_capacita_2 :            $('#doc_capacita_2').val()

        };

        console.log(data_form);

        // Calcular el tiempo que lleva el cartificado vigente
        let fec_cap_1 =  calcularEdad(data_form.fech_capacita);

        // Validacion de otros estudios
        data_form.lug_capaci == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
        data_form.lug_capacita == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
        data_form.fech_capacita == "" ? msg += "- Ingresar la fecha de finalización<br>" : "";
        data_form.doc_capacita == "" ? msg += "- Debe anexar el certificado<br>" : "";
        fec_cap_1 > 0 ? msg += "- Su <b>certificado de capacitacion</b> de la primera seccion ya expiro " : "";

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            $('#checkNo').prop("checked",true);
            section_ul.style.marginLeft = "-600%";
            section_ul.style.transition = "1.5s";
        } 

    });

    // INTERACCION CON EL BOTON SIGUIENTE DE LA SECCION DE CAPACITACIONES //
    $('#btn_sig_capacita').click(function (e){ 
        e.preventDefault();

        // Declaracion de variables
        let msg = "";

        // Se establece el data form para las validaciones posteriores
        var data_form = {

            lug_capaci :                $('#lug_capaci').val(),
            lug_capacita :              $('#lug_capacita').val(),
            fech_capacita :             $('#fech_capacita').val(),
            doc_capacita :              $('#doc_capacita').val(),

            lug_capaci_2 :              $('#lug_capaci_2').val(),
            lug_capacita_2 :            $('#lug_capacita_2').val(),
            fech_capacita_2 :           $('#fech_capacita_2').val(),
            // doc_capacita_2 :            $('#doc_capacita_2').val()

        };

        console.log(data_form);

        // Calcular el tiempo que lleva el cartificado vigente
        let fec_cap_1 =  calcularEdad(data_form.fech_capacita);
        let fec_cap_2 = calcularEdad(data_form.fech_capacita_2);

        // Se agrupan por secciones de capacitaciones para trabajar las validaciones por grupos
        // let primer_capacitacion = data_form.lug_capaci + data_form.lug_capacita + data_form.fech_capacita + data_form.doc_capacita;
        // let segunda_capacitacion = data_form.lug_capaci_2 + data_form.lug_capacita_2 + data_form.fech_capacita_2 + data_form.doc_capacita_2;
        let segunda_capacitacion = data_form.lug_capaci_2 + data_form.lug_capacita_2 + data_form.fech_capacita_2;

        // Validacion de otros estudios
        data_form.lug_capaci == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
        data_form.lug_capacita == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
        data_form.fech_capacita == "" ? msg += "- Ingresar la fecha de finalización<br>" : "";
        data_form.doc_capacita == "" ? msg += "- Debe anexar el certificado <br>" : "";
        fec_cap_1 > 0 ? msg += "- Su certificado de capacitacion de la primera seccion ya expiro " : "";

        if (segunda_capacitacion !== "--") {
            (data_form.lug_capaci_2 == "" || data_form.lug_capacita_2 == "" || data_form.fech_capacita_2 == "" || fec_cap_2 > 0) ? msg += "PARA LA SEGUNDA SECCION DE CAPACITACION DEBE INGRESAR: <br>" : "";
            data_form.lug_capaci_2 == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
            data_form.lug_capacita_2 == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
            data_form.fech_capacita_2 == "" ? msg += "- Debe ingresar la fecha de finalización<br>" : "";
            // data_form.doc_capacita_2 == "" ? msg += "- Debe anexar el <b>certificado</b> de la segunda seccion <br>" : "";
            fec_cap_2 > 0 ? msg += "- Su certificado de capacitacion de la segunda seccion ya expiro" : "";
        }

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            section_ul.style.marginLeft = "-600%";
            section_ul.style.transition = "1.5s";
        } 

    });

    
    // INTERACCION CON EL BOTON ATRAS DE LA SECCION DE CUALIFICACION //
    $('#btn_atr_cualifi').click(function (e) {
        e.preventDefault(); 
        section_ul.style.marginLeft = "-500%";
        section_ul.style.transition = "1.5s";
    });

    // INTERACCION CON EL BOTON SIGUIENTE DE LA SECCION DE CUALIFICACION //
    $('#btn_sig_cualifi').click(function (e) {
        e.preventDefault();

        // Declaracion de variables
        let msg = "";

        // Se establece el data form para las validaciones posteriores
        var data_form = {

            lug_cuali :                 $('#lug_cuali').val(),
            lug_cualifica :             $('#lug_cualifica').val(),
            fech_cualifi :              $('#fech_cualifi').val(),
            // doc_cualifi :               $('#doc_cualifi').val(),

            lug_cuali_2 :               $('#lug_cuali_2').val(),
            lug_cualifica_2 :           $('#lug_cualifica_2').val(),
            fech_cualifi_2 :            $('#fech_cualifi_2').val(),
            // doc_cualifi_2 :             $('#doc_cualifi_2').val()

        };

        console.log(data_form);

        // Calcular el tiempo que lleva el cartificado vigente
        let fec_cual_1 =  calcularEdad(data_form.fech_cualifi);
        let fec_cual_2 = calcularEdad(data_form.fech_cualifi_2);

        // Se agrupan por secciones de capacitaciones para trabajar las validaciones por grupos
        // let primera_cua = data_form.lug_cuali + data_form.lug_cualifica + data_form.fech_cualifi + data_form.doc_cualifi;
        let primera_cua = data_form.lug_cuali + data_form.lug_cualifica + data_form.fech_cualifi;
        // let segundo_cua = data_form.lug_cuali_2 + data_form.lug_cualifica_2 + data_form.fech_cualifi_2 + data_form.doc_cualifi_2;
        let segundo_cua = data_form.lug_cuali_2 + data_form.lug_cualifica_2 + data_form.fech_cualifi_2;

        // Validacion de otros estudios
        if (primera_cua !== "--") {
            (data_form.lug_cuali == "" || data_form.lug_cualifica == "" || data_form.fech_cualifi == "" || (fec_cual_1 > 0 && data_form.lug_cualifica !== "01") || (fec_cual_1 > 2 && data_form.lug_cualifica == "01")) ? msg += "PARA LA PRIMERA SECCION DE CUALIFICACION DEBE INGRESAR: <br>" : "";
            data_form.lug_cuali == "" ? msg += "- ingresar el nombre del instituto<br>" : "";
            data_form.lug_cualifica == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
            data_form.fech_cualifi == "" ? msg += "- Ingresar la fecha de finalización<br>" : "";
            // data_form.doc_cualifi == "" ? msg += "- Debe anexar el <b>certificado</b> de la primera seccion <br>" : "";
            fec_cual_1 > 0 && data_form.lug_cualifica !== "01" ? msg += "- Su certificado de cualificacion de la primera seccion ya expiro " : "";
            fec_cual_1 > 2 && data_form.lug_cualifica == "01" ? msg += "- Su certificado de cualificacion de la primera seccion ya expiro " : "";
        }

        if (segundo_cua !== "--") {
            (data_form.lug_cuali_2 == "" || data_form.lug_cualifica_2 == "" || data_form.fech_cualifi_2 == "" || (fec_cual_2 > 0 && data_form.lug_cualifica_2 !== "01") || (fec_cual_2 > 2 && data_form.lug_cualifica_2 == "01")) ? msg += "PARA LA SEGUNDA SECCION DE CUALIFICACION DEBE INGRESAR: <br>" : "";
            data_form.lug_cuali_2 == "" ? msg += "- Ingresar el nombre del instituto<br>" : "";
            data_form.lug_cualifica_2 == "" ? msg += "- Ingresar el titulo optenido<br>" : "";
            data_form.fech_cualifi_2 == "" ? msg += "- Ingresar la fecha de finalización<br>" : "";
            // data_form.doc_cualifi_2 == "" ? msg += "- Debe anexar el <b>certificado</b> de la segunda seccion <br>" : "";
            fec_cual_2 >= 0 && data_form.lug_cualifica_2 == "01" ? msg += "- Su certificado de cualificacion de la segunda seccion ya expiro" : "";
            fec_cual_2 > 2 && data_form.lug_cualifica_2 == "01" ? msg += "- Su certificado de cualificacion de la primera seccion ya expiro " : "";
        }

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }

        // Interaccion en el sistema en caso de no tener errores
        if (msg == "") {
            section_ul.style.marginLeft = "-700%";
            section_ul.style.transition = "1.5s";
        } 
        
    });


    // INTERACCION CON EL BOTON ATRAS DE LA REFERENCIA LABORAL //
    $('#btn_atr_fin').click(function (e) {
        e.preventDefault(); 
        section_ul.style.marginLeft = "-500%";
        section_ul.style.transition = "1.5s";
    });

    // Interaccion de los terminos y condiciones
    $('#termino').click(function () {
        if ($(this).prop('checked')) {
            $("#btn_env").prop('disabled', false).css("opacity", "1");
        } else {
            $("#btn_env").prop('disabled', true).css("opacity", "0.5");
        }
    });

    // Interaccion de activacion de boton de envio
    if ($('#termino').prop('checked')) {
        $("#btn_env").prop('disabled', false).css("opacity", "1");
    } else {
        $("#btn_env").prop('disabled', true).css("opacity", "0.5");
    }
    
    // INTERACCION CON EL BOTON DE FINALIZAR PARA EL ENVIO Y VERIFICACION DE TOKEN //
    $('#btn_env').click(function (e) { 
        e.preventDefault();
        let msg = "";
        var data_form = {
            // informacion general
            archivo:                    $('#archivo').val(),

            // Nombre
            primer_nombre :             $('#primer_nombre').val(),
            primer_apellido :           $('#primer_apellido').val(),

            // Correo
            correo :                    $('#correo').val(),

            // referencias
            nomb_ref:                   $('#nomb_ref').val(),
            ape_ref:                    $('#ape_ref').val(),
            cel_ref:                    $('#cel_ref').val(),
            car_ref:                    $('#car_ref').val(),

            nomb_ref_2:                 $('#nomb_ref_2').val(),
            ape_ref_2:                  $('#ape_ref_2').val(),
            cel_ref_2:                  $('#cel_ref_2').val(),
            car_ref_2:                  $('#car_ref_2').val(),
            tipo:                       "N"
        };

        console.log(data_form);

        // Se agrupan por secciones de capacitaciones para trabajar las validaciones por grupos
        let primera_ref_per = data_form.nomb_ref + data_form.ape_ref + data_form.cel_ref + data_form.car_ref;
        let segundo_ref_per = data_form.nomb_ref_2 + data_form.ape_ref_2 + data_form.cel_ref_2 + data_form.car_ref_2;

        // Extensiones de documentos
        var extPermitidas = /(.png|.gif|.jpg|.jpeg|.PNG|.GIF|.JPG|.JPEG)$/i;

        // Validacion informacion general
        if( data_form.archivo.length !== 0) {
            var filename = $('#archivo').val().replace(/C:\\fakepath\\/i, '')
            var valor = data_form.archivo;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        // Validacion de referencias personales y foto
        data_form.archivo.length == 0 ? msg += "- Debe ingresar una foto de perfil <br>" : "";
        
        if (primera_ref_per !== "") {
            data_form.nomb_ref == "" ? msg += "- Debe ingresar el <b>nombre de la persona</b> en la primera seccion <br>" : "";
            data_form.ape_ref == "" ? msg += "- Debe ingresar el <b>apellido de la persona</b> en la primera seccion <br>" : "";
            data_form.cel_ref == "" ? msg += "- Debe ingresar el <b>celular de la persona</b> en la primera seccion <br>" : "";
            data_form.car_ref == "" ? msg += "- Debe ingresar el <b>cargo de la persona</b> en la primera seccion <br>" : "";
        }

        if (segundo_ref_per !== "") {
            data_form.nomb_ref_2 == "" ? msg += "- Debe ingresar el <b>nombre de la persona</b> en la segunda seccion <br>" : "";
            data_form.ape_ref_2 == "" ? msg += "- Debe ingresar el <b>apellido de la persona</b> en la segunda seccion <br>" : "";
            data_form.cel_ref_2 == "" ? msg += "- Debe ingresar el <b>celular de la persona</b> en la segunda seccion <br>" : "";
            data_form.car_ref_2 == "" ? msg += "- Debe ingresar el <b>cargo de la persona</b> en la segunda seccion <br>" : "";
        }

        // Mostrar mensaje de error en caso de tener alguno
        if (msg !== "") {
            $('#Cont_faltante').show();
            $('#cont_msg').html(msg);
        }
        
        // En caso de estar correcto, se realiza una interaccion en el sistema con ajax para asi generar y enviar un token por correo electronico
        if (msg == "") {
            const url_token = "../controlador/controlador_token.php";
            var codigo_pin = generarAleatorios(8);

            // Mostrar ventana emergente de carga
            Swal.fire({
                title: 'Enviando PIN...',
                text: 'Por favor espera mientras se envía el PIN de verificación.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            // Envio ajax
            $.ajax({
                beforeSend :function () {
                    $("#Cont_carga").show();
                },
                type: "POST",
                url: url_token,
                data: {nombre: data_form.primer_nombre, apellido: data_form.primer_apellido, token: codigo_pin, correo: data_form.correo, tipo: data_form.tipo},
                dataType: "json",
                async: true
            })
            .done(function ajaxDone(res){
                
                Swal.close();  // Cerrar la ventana emergente de carga cuando la solicitud haya terminado

                if (res.error !== undefined) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la inscripción',
                        text: res.error
                    });
                }

                if (res.mensaje !== undefined) {
                    $('#Cont_token').show();
                    $('#msg_mail').html(res.correo);
                    $('#invisible').html(res.mensaje);
                    $('#btn_can_token').click(function (e) {
                        e.preventDefault();
                        $('#Cont_token').hide();
                    });
                }

            })
            .always(function ajaxSiempre() {
                $("#Cont_carga").hide();
            });
        }
    });

    // ***************************************************************************************************** //
    // ************************** INTERACCIÓN REGISTRO PERSONA NATURAL ************************************* //
    // ***************************************************************************************************** //
    $(document).on("submit","#cuerpo_registro_nat",function(event){
        event.preventDefault();
        let token_invi = document.getElementById('token_invi').value;
        let token_nat = document.getElementById('contDeToken').value;
        var frmDATA = new FormData;
        let form = $(this);

        // Foto
        var archivo                    = $('#archivo',form).prop('files')[0];

        // Informacion general
        var primer_nombre              = $('#primer_nombre',form).val();
        var segundo_nombre             = $('#segundo_nombre',form).val();
        var primer_apellido            = $('#primer_apellido',form).val();
        var segundo_apellido           = $('#segundo_apellido',form).val();
        var tipo_de_documento          = $('#tipo_de_documento',form).val();
        var cedula_de_ciudadania       = $('#cedula_de_ciudadania',form).val();
        var fecha_nacimiento           = $('#fecha_nacimiento',form).val();
        var sexo                       = $('#sexo',form).val();
        var ednia                      = $('#ednia',form).val();
        var edad                       = $('#edad',form).val();

        // Informacion de contacto
        var direccion                  = $('#direccion',form).val();
		var departamento               = $('#departamento',form).val();
        var municipios                 = $('#municipios',form).val();
        var celular_cont               = $('#celular_cont',form).val();
        var correo                     = $('#correo',form).val();
        var correo_conf                = $('#correo_conf',form).val();
        var contrasena                 = $('#contrasena',form).val();
        var conf_contrasena            = $('#conf_contrasena',form).val();
        var posee_lib                  = $('#posee_lib',form).val();
        var numero_lib                 = $('#numero_lib',form).val();
        var posee_lic                  = $('#posee_lic',form).val();
        var numero_lic                 = $('#numero_lic',form).val();
        var cate_lic                   = $('#cate_lic',form).val();
        var contacto_area              = $('#contacto_area',form).val();

        // Referencia labora;
        var nombre_empresa             = $('#nombre_empresa',form).val();
        var cargo                      = $('#cargo',form).val();
        var tiempo_ingreso_exp         = $('#tiempo_ingreso_exp',form).val();
        var sig_trab =                   $('#sig_trab',form).val();
        var cargo_dese                 = $('#cargo_dese',form).val();
        var tiempo_salida_1            = $('#tiempo_salida_1',form).val();
        var jefe_inmediato             = $('#jefe_inmediato',form).val();
        var celular_exp                = $('#celular_exp',form).val();
        var compro_laboral             = $('#compro_laboral',form).prop('files')[0];

        var nombre_empresa_2           = $('#nombre_empresa_2',form).val();
        var cargo_2                    = $('#cargo_2',form).val();
        var tiempo_ingreso_exp_2       = $('#tiempo_ingreso_exp_2',form).val();
        var tiempo_salida_2            = $('#tiempo_salida_2',form).val();
        var sig_trab_2                 = $('#sig_trab_2',form).val();
        var cargo_dese_2               = $('#cargo_dese_2',form).val();
        var jefe_inmediato_2           = $('#jefe_inmediato_2',form).val();
        var celular_exp_2              = $('#celular_exp_2',form).val();
        var compro_laboral_2           = $('#compro_laboral_2',form).prop('files')[0];

        // Referencia academica
        var nombre_instituto           = $('#nombre_instituto',form).val();
        var nivel_academico            = $('#nivel_academico',form).val();
        var titulo_op                  = $('#titulo_op',form).val();
        var culm_aca                   = $('#culm_aca',form).val();
        var tiempo_fin_1               = $('#tiempo_fin_1',form).val();
        var sigo_estu                  = $('#sigo_estu',form).prop('checked');
        var comp_est_for               = $('#comp_est_for',form).prop('files')[0];
        
        var nombre_instituto_2         = $('#nombre_instituto_2',form).val();
        var nivel_academico_2          = $('#nivel_academico_2',form).val();
        var titulo_op_2                = $('#titulo_op_2',form).val();
        var culm_aca_2                 = $('#culm_aca_2',form).val();
        var tiempo_fin_2               = $('#tiempo_fin_2',form).val();
        var sigo_estu_2                = $('#sigo_estu_2',form).prop('checked');
        var comp_est_for_2             = $('#comp_est_for_2',form).prop('files')[0];

        // Otro: cursos, diplomas, seminarios;
        var nombre_instituto_otro      = $('#nombre_instituto_otro',form).val();
        var titulo_op_otro             = $('#titulo_op_otro',form).val();
        var tiempo_fin_otro_1          = $('#tiempo_fin_otro_1',form).val();
        var comp_otro                  = $('#comp_otro',form).prop('files')[0];

        var nombre_instituto_otro_2    = $('#nombre_instituto_otro_2',form).val();
        var titulo_op_otro_2           = $('#titulo_op_otro_2',form).val();
        var tiempo_fin_otro_2          = $('#tiempo_fin_otro_2',form).val();
        var comp_otro_2                = $('#comp_otro_2',form).prop('files')[0];

        // Capacitaciones
        var lug_capaci                  = $('#lug_capaci',form).val();
        var lug_capacita                = $('#lug_capacita',form).val();
        var fech_capacita               = $('#fech_capacita',form).val();
        var doc_capacita                = $('#doc_capacita',form).prop('files')[0];

        var lug_capaci_2                = $('#lug_capaci_2',form).val();
        var lug_capacita_2              = $('#lug_capacita_2',form).val();
        var fech_capacita_2             = $('#fech_capacita_2',form).val();
        var doc_capacita_2              = $('#doc_capacita_2',form).prop('files')[0];

        var checkNo                    = $('#checkNo',form).prop('checked');

        // Cualificaciones
        var lug_cuali                  = $('#lug_cuali',form).val();
        var lug_cualifica              = $('#lug_cualifica',form).val();
        var fech_cualifi               = $('#fech_cualifi',form).val();
        var doc_cualifi                = $('#doc_cualifi',form).prop('files')[0];

        var lug_cuali_2                = $('#lug_cuali_2',form).val();
        var lug_cualifica_2            = $('#lug_cualifica_2',form).val();
        var fech_cualifi_2             = $('#fech_cualifi_2',form).val();
        var doc_cualifi_2              = $('#doc_cualifi_2',form).prop('files')[0];

        // Referencias
        var nomb_ref                   = $('#nomb_ref',form).val();
        var ape_ref                    = $('#ape_ref',form).val();
        var cel_ref                    = $('#cel_ref',form).val();
        var car_ref                    = $('#car_ref',form).val();

        var nomb_ref_2                 = $('#nomb_ref_2',form).val();
        var ape_ref_2                  = $('#ape_ref_2',form).val();
        var cel_ref_2                  = $('#cel_ref_2',form).val();
        var car_ref_2                  = $('#car_ref_2',form).val();

        // Foto
        frmDATA.append('archivo',archivo);

        // Informacion general
        frmDATA.append('primer_nombre',primer_nombre);
        frmDATA.append('segundo_nombre',segundo_nombre);
        frmDATA.append('primer_apellido',primer_apellido);
        frmDATA.append('segundo_apellido',segundo_apellido);
        frmDATA.append('tipo_de_documento',tipo_de_documento);
        frmDATA.append('cedula_de_ciudadania',cedula_de_ciudadania);
        frmDATA.append('fecha_nacimiento',fecha_nacimiento);
        frmDATA.append('sexo',sexo);
        frmDATA.append('ednia',ednia);
        frmDATA.append('edad',edad);

        // Informacion de contactacto
        frmDATA.append('direccion',direccion);
		frmDATA.append('departamento',departamento);
        frmDATA.append('municipios',municipios);
        frmDATA.append('celular_cont',celular_cont);
        frmDATA.append('correo',correo);
        frmDATA.append('correo_conf',correo_conf);
        frmDATA.append('contrasena',contrasena);
        frmDATA.append('conf_contrasena',conf_contrasena);
        frmDATA.append('posee_lib',posee_lib);
        frmDATA.append('numero_lib',numero_lib);
        frmDATA.append('posee_lic',posee_lic);
        frmDATA.append('numero_lic',numero_lic);
        frmDATA.append('cate_lic',cate_lic);
        frmDATA.append('contacto_area',contacto_area);

        // Referencias laborales
        frmDATA.append('nombre_empresa',nombre_empresa);
        frmDATA.append('cargo',cargo);
        frmDATA.append('cargo_dese',cargo_dese);
        frmDATA.append('tiempo_ingreso_exp',tiempo_ingreso_exp);
        frmDATA.append('tiempo_salida_1',tiempo_salida_1);
        frmDATA.append('sig_trab',sig_trab);
        frmDATA.append('jefe_inmediato',jefe_inmediato);
        frmDATA.append('celular_exp',celular_exp);
        frmDATA.append('compro_laboral',compro_laboral);

        frmDATA.append('nombre_empresa_2',nombre_empresa_2);
        frmDATA.append('cargo_2',cargo_2);
        frmDATA.append('cargo_dese_2',cargo_dese_2);
        frmDATA.append('tiempo_ingreso_exp_2',tiempo_ingreso_exp_2);
        frmDATA.append('tiempo_salida_2',tiempo_salida_2);
        frmDATA.append('sig_trab_2',sig_trab_2);
        frmDATA.append('jefe_inmediato_2',jefe_inmediato_2);
        frmDATA.append('celular_exp_2',celular_exp_2);
        frmDATA.append('compro_laboral_2',compro_laboral_2);

        // Referencias academicas
        frmDATA.append('nombre_instituto',nombre_instituto);
        frmDATA.append('nivel_academico',nivel_academico);
        frmDATA.append('titulo_op',titulo_op);
        frmDATA.append('culm_aca',culm_aca);
        frmDATA.append('tiempo_fin_1',tiempo_fin_1);
        frmDATA.append('sigo_estu',sigo_estu);
        frmDATA.append('comp_est_for',comp_est_for);

        frmDATA.append('nombre_instituto_2',nombre_instituto_2);
        frmDATA.append('nivel_academico_2',nivel_academico_2);
        frmDATA.append('titulo_op_2',titulo_op_2);
        frmDATA.append('culm_aca_2',culm_aca_2);
        frmDATA.append('tiempo_fin_2',tiempo_fin_2);
        frmDATA.append('sigo_estu_2',sigo_estu_2);
        frmDATA.append('comp_est_for_2',comp_est_for_2);

        //  Otro: cursos, diplomas, seminarios;
        frmDATA.append('nombre_instituto_otro',nombre_instituto_otro);
        frmDATA.append('titulo_op_otro',titulo_op_otro);
        frmDATA.append('tiempo_fin_otro_1',tiempo_fin_otro_1);
        frmDATA.append('comp_otro',comp_otro);

        frmDATA.append('nombre_instituto_otro_2',nombre_instituto_otro_2);
        frmDATA.append('titulo_op_otro_2',titulo_op_otro_2);
        frmDATA.append('tiempo_fin_otro_2',tiempo_fin_otro_2);
        frmDATA.append('comp_otro_2',comp_otro_2);

        // Capacitaciones
        frmDATA.append('lug_capaci',lug_capaci);
        frmDATA.append('lug_capacita',lug_capacita);
        frmDATA.append('fech_capacita',fech_capacita);
        frmDATA.append('doc_capacita',doc_capacita);

        frmDATA.append('lug_capaci_2',lug_capaci_2);
        frmDATA.append('lug_capacita_2',lug_capacita_2);
        frmDATA.append('fech_capacita_2',fech_capacita_2);
        frmDATA.append('doc_capacita_2',doc_capacita_2);

        frmDATA.append('checkNo',checkNo);

        // Cualificaciones
        frmDATA.append('lug_cuali',lug_cuali);
        frmDATA.append('lug_cualifica',lug_cualifica);
        frmDATA.append('fech_cualifi',fech_cualifi);
        frmDATA.append('doc_cualifi',doc_cualifi);

        frmDATA.append('lug_cuali_2',lug_cuali_2);
        frmDATA.append('lug_cualifica_2',lug_cualifica_2);
        frmDATA.append('fech_cualifi_2',fech_cualifi_2);
        frmDATA.append('doc_cualifi_2',doc_cualifi_2);        

        // Referencias personales
        frmDATA.append('nomb_ref',nomb_ref);
        frmDATA.append('ape_ref',ape_ref);
        frmDATA.append('cel_ref',cel_ref);
        frmDATA.append('car_ref',car_ref);

        frmDATA.append('nomb_ref_2',nomb_ref_2);
        frmDATA.append('ape_ref_2',ape_ref_2);
        frmDATA.append('cel_ref_2',cel_ref_2);
        frmDATA.append('car_ref_2',car_ref_2);

        if (token_invi === token_nat) {

            // Mostrar ventana emergente de carga
            Swal.fire({
                title: 'Registrando...',
                text: 'Por favor espera mientras procesamos tu inscripción.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
        
            const url_nat = "../controlador/controlador_registrar_usuario_natural.php";
            $.ajax({
                type: "POST",
                url: url_nat,
                data: frmDATA,
                contentType: false,
                processData: false,
                dataType: 'json',
                async: true
            })
            .done(function ajaxDone(res) {
                Swal.close();  // Cerrar la ventana emergente de carga
        
                if (res.error !== undefined) {
                    Swal.fire({
                        title: "¡Opps! Ha surgido un error",
                        icon: "error",
                        text: "Error en la inscripción: " + res.error
                    });
                }
        
                if (res.mensaje !== undefined) {
                    if (res.checkNo == "true") {
                        Swal.fire({
                            title: "Cualifícate con AIEX OCP",
                            html: "<img src='../img/cualificate con nosotros.jpeg' id='noCuali' alt='cualificate'> <br> <a href='https://wa.link/p8sl1l' target='_BLANK' rel='noreferrer noopener'>Comunícate con nosotros</a>",
                            showConfirmButton: false
                        });
                        
                        // Mostrar el siguiente mensaje después de 5 segundos
                        setTimeout(() => {
                            Swal.fire({
                                title: "¡Eso es estupendo! Ya completaste tu perfil",
                                icon: "success",
                                showConfirmButton: false
                            });
                            // Redirigir después de 3 segundos
                            setTimeout(() => {
                                window.location.href = res.url;
                            }, 3000);
                        }, 5000);
                    } else {
                        Swal.fire({
                            title: "¡Eso es estupendo! Ya completaste tu perfil",
                            icon: "success",
                            showConfirmButton: false
                        });
                        // Redirigir después de 5 segundos
                        setTimeout(() => {
                            window.location.href = res.url;
                        }, 5000);
                    }
                }
            })
            .fail(function ajaxFailed(e) {
                Swal.close();  // Cerrar la ventana emergente de carga en caso de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema con la inscripción. Por favor intenta de nuevo.'
                });
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Código incorrecto',
                text: 'El código de confirmación es incorrecto. Por favor, inténtalo nuevamente.'
            });
        }
        
    });
    

    // ****************************************************************************************************** //
    // ********************************** BOTONES  FORMULARIO EMPRESA *************************************** //
    // ****************************************************************************************************** //

    $('#btn_sig_inf_gen_emp').click(async function (event) {  // 👈 ahora la función es async
        event.preventDefault();

        let msg = ""; // 👈 declaramos la variable para acumular errores

        // Data Form para llamar todos los elementos del DOM por ID
        var data_form = {
            nit: $('#nit').val(),
        };

        let nit = data_form.nit.trim();

        // Validamos que no esté vacío
        if (nit === "") {
            msg += "- Ingrese un número de NIT válido <br>";
        } else {
            try {
                let response = await fetch("../obtener_datos/empresa/validar_nit.php", { // 👈 mejor usa un PHP específico para empresas
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "nit=" + encodeURIComponent(nit)
                });

                let data = await response.json();

                if (data.existe) {
                    msg += "- El número de NIT ya se encuentra registrado <br>";
                }
            } catch (error) {
                console.error("Error:", error);
                msg += "- Error al validar el NIT <br>";
            }
        }

        // Mostrar errores si existen
        if (msg !== "") {
            $('#cont_error_emp').show();
            $('#cont_msg_emp').html(msg);
            return; // 👈 detenemos aquí si hubo errores
        }

        // Si no hay errores, continuar con la transición
        section_ul_emp.style.marginLeft = "-100%";
        section_ul_emp.style.transition = "1.5s";

        let inputValue = document.getElementById("contacto_area_emp").value; 
        let razon_social = document.getElementById("razon_social").value;

        document.getElementById("valueInputName").innerHTML = razon_social;
        document.getElementById("inputValue").innerHTML = inputValue; 
    });


    $('#btn_sig_cont_emp').click(function(event) {
        event.preventDefault();
        section_ul_emp.style.marginLeft = "-200%";
        section_ul_emp.style.transition = "1.5s";
    });

    $('#btn_atr_cont_emp').click(function (event) {
        event.preventDefault();
        section_ul_emp.style.marginLeft = "0%";
        section_ul_emp.style.transition = "1.5s";
    });

    $('#btn_sig_mi_vi').click(function (event) {
        event.preventDefault();
        section_ul_emp.style.marginLeft = "-300%";
        section_ul_emp.style.transition = "1.5s";
    });

    $('#btn_atr_mi_vi').click(function (event) {
        event.preventDefault();
        section_ul_emp.style.marginLeft = "-100%";
        section_ul_emp.style.transition = "1.5s";
    });

    $('#btn_atr_log').click(function (event) {
        event.preventDefault();
        section_ul_emp.style.marginLeft = "-200%";
        section_ul_emp.style.transition = "1.5s";
    });

    $('#acVenEm').click(function (e) { 
        e.preventDefault();
        $('#Cont_faltante').hide();
    });

    $('#acVenEmEm').click(function (e) { 
        e.preventDefault();
        $('#cont_error_emp').hide();
    });

    $('#acVenEmLo').click(function (e) { 
        e.preventDefault();
        $('#contVeEmLo').hide();
    });

    $('#acVenEmVacM').click(function (e) { 
        e.preventDefault();
        $('#contMsg').hide();
    });

    $('#acVenEmVacMPN').click(function (e) { 
        e.preventDefault();
        $('#contMsgPN').hide();
    });

    $('#cualifi__insert').hide();
    $('#insertar_ref_per').hide();
    $('#insertar_form_prin').hide();
    $('#insertar_form_aca').hide();
    $('#capacita__insert').hide();
    $('#insertar_cue_otro').hide();

    $('#insertar_form').click(function (e){
        e.preventDefault();
        $('#insertar_form_prin').show(
            insertar_form.disabled = true
        );
    });

    $('#insertar_form_for_aca').click(function (e){
        e.preventDefault();
        $('#insertar_form_aca').show(
            insertar_form_for_aca.disabled = true
        );
    });

    $('#insertar_otro').click(function (e){
        e.preventDefault();
        $('#insertar_cue_otro').show(
            insertar_otro.disabled = true
        );
    });

    $('#insertar_form_cualifi').click(function (e){
        e.preventDefault();
        $('#cualifi__insert').show(
            insertar_form_cualifi.disabled = true
        );
    });

    $('#insertar_form_capacita').click(function (e){
        e.preventDefault();
        $('#capacita__insert').show(
            insertar_form_capacita.disabled = true
        );
    });

    $('#insertar_ref_per_but').click(function (e){
        e.preventDefault();
        $('#insertar_ref_per').show(
            insertar_ref_per_but.disabled = true
        );
    });

    $(document).on('click','#per_emp',function (e) {
        e.preventDefault();
        window.location.href="../pages/empresa/perfil_empresa.php";
    });

    

    $('#termino_emp').click(function () {
        if ($(this).prop('checked')) {
            $("#btn_env_emp").prop('disabled', false).css("opacity", "1");
        } else {
            $("#btn_env_emp").prop('disabled', true).css("opacity", "0.5");
        }
    });

    if ($('#termino_emp').prop('checked')) {
        $("#btn_env_emp").prop('disabled', false).css("opacity", "1");
    } else {
        $("#btn_env_emp").prop('disabled', true).css("opacity", "0.5");
    }

    $('#cont_termino').click(function (e) { 
        e.preventDefault();
        $('#Cont_faltante').show(); 
        $('#cont_msg').html(`
            <textarea name="" id="terCon" cols="30" rows="10" disabled>
                Condiciones Legales y Política de Privacidad Vigiempleo.com 
                Bienvenido/a a nuestra página de vigiempleo.com Antes de continuar utilizando nuestros servicios, es importante que leas y comprendas nuestras condiciones legales y nuestra política de privacidad. Estas condiciones y políticas están sustentadas en la ley de habeas data, que establece los derechos y obligaciones relacionados con la protección de datos personales en Colombia.

                Recopilación de datos personales
                Como página de empleo, recopilamos cierta información personal de nuestros usuarios con el fin de brindarles un mejor servicio. Esta información puede incluir nombres, direcciones de correo electrónico, números de teléfono y currículums. Nos comprometemos a recopilar solo la información necesaria y a protegerla adecuadamente de acuerdo con la legislación vigente.

                Uso de datos personales
                La información personal recopilada se utilizará exclusivamente con el propósito de facilitar la búsqueda de empleo y la conexión entre empleadores y candidatos. Utilizaremos esta información para brindar recomendaciones de empleo, enviar notificaciones relevantes y mejorar la experiencia del usuario en nuestra plataforma. No compartiremos ni venderemos esta información a terceros sin el consentimiento expreso del usuario, a menos que estemos legalmente obligados a hacerlo.

                Consentimiento del usuario
                Antes de recopilar cualquier dato personal, solicitaremos tu consentimiento expreso. Al registrarte en nuestra página de empleo y proporcionar tu información personal, estás aceptando nuestras condiciones legales y política de privacidad. Si en algún momento deseas revocar tu consentimiento o eliminar tu información personal de nuestra base de datos, puedes comunicarte con nuestro equipo de soporte. Email:  contacto@vigiempleo.com

                Seguridad de datos
                Nos comprometemos a implementar medidas de seguridad técnicas y organizativas para proteger tus datos personales de accesos no autorizados, pérdida o robo. Utilizamos tecnologías de cifrado y controles de acceso para garantizar la confidencialidad y la integridad de tus datos. Sin embargo, debes tener en cuenta que ninguna medida de seguridad en Internet es completamente infalible y no podemos garantizar una protección absoluta.

                Derechos de los usuarios
                De acuerdo con la ley de habeas data, como usuario tienes derechos sobre tus datos personales. Tienes el derecho de acceder a la información que tenemos sobre ti, rectificarla en caso de ser incorrecta, actualizarla si es necesario y solicitar su eliminación si ya no deseas que la conservemos. Para ejercer estos derechos, puedes comunicarte con nuestro equipo de soporte y te proporcionaremos la asistencia necesaria.

                Cookies y tecnologías similares
                Utilizamos cookies y tecnologías similares para mejorar tu experiencia en nuestra página de empleo. Estas tecnologías nos permiten recordar tus preferencias, personalizar el contenido y realizar análisis estadísticos. Puedes gestionar tus preferencias de cookies a través de la configuración de tu navegador.

                Cambios en la política de privacidad
                Nos reservamos el derecho de realizar cambios en nuestra política de privacidad en cualquier momento. Te recomendamos revisar periódicamente esta política para estar al tanto de cualquier actualización. Los cambios entrarán en vigencia a partir de su publicación en nuestra página de empleo.

                Al utilizar nuestra página de vigiempleo.com, aceptas nuestras condiciones legales y política de privacidad. Si no estás de acuerdo con alguno de los términos establecidos, te recomendamos que no utilices nuestros servicios. Si tienes alguna pregunta o inquietud sobre nuestras condiciones y políticas, no dudes en contactarnos. Estamos comprometidos con proteger tu privacidad y brindarte una experiencia segura y confiable en nuestra plataforma.
                En resumen, nuestra página de vigiempleo.com cumple con la ley de habeas data y se compromete a proteger tus datos personales de acuerdo con los más altos estándares de seguridad. Confiamos en que nuestra plataforma te brindará una experiencia positiva y te ayudará a encontrar oportunidades laborales de calidad. ¡Gracias por confiar en nosotros!
            </textarea>    
        `);
    });

    let $conten_token = $('#contDeToken');
    let $btn_acp_token = $('#btn_acp_token');

    $conten_token.on('input', function() {
        if ($(this).val().length === 8) {
            $btn_acp_token.prop('disabled', false);
            $('#btn_acp_token').css('opacity', 1);
        } else {
            $btn_acp_token.prop('disabled', true);
            $('#btn_acp_token').css('opacity', 0.5);
        }
    });
    
    $("#numero_lib").prop("disabled", true);

    $("#posee_lib").on("input", function() {
        var poseeLibValue = $(this).val();
    
        if (poseeLibValue === "no" || poseeLibValue === "--" ) {
            $("#numero_lib").val("");
            $("#numero_lib").prop("disabled", true);
            $('#cont_num_lib').css("display", "none"); 
        } else {
            $("#numero_lib").prop("disabled", false);
            $('#cont_num_lib').css("display", "block"); 
        }
    });
    
    $("#numero_lic").prop("disabled", true);
    $("#cate_lic").prop("disabled", true);

    $("#posee_lic").on("input", function() {
        var poseeLibValue = $(this).val();
    
        if (poseeLibValue === "no" || poseeLibValue === "--" ) {
            $("#numero_lic").val("");
            $("#numero_lic").prop("disabled", true);
            $("#cate_lic").val("");
            $("#cate_lic").prop("disabled", true);
            $('#cont_num_lic').css("display", "none"); 
        } else {
            $("#numero_lic").prop("disabled", false);
            $("#cate_lic").prop("disabled", false);
            $('#cont_num_lic').css("display", "block"); 
        }
    });

    $("#cargo").on("input", function() {
        var cargoValue = $(this).val();
    
        if (cargoValue === "06") {
            $('#cont_otro_cargo').css("display", "block"); 
        } else {
            $('#cont_otro_cargo').css("display", "none"); 
        }
    });

    $("#cargo_2").on("input", function() {
        var cargoValue = $(this).val();
    
        if (cargoValue === "06") {
            $('#cont_otro_cargo_2').css("display", "block"); 
        } else {
            $('#cont_otro_cargo_2').css("display", "none"); 
        }
    });

    $("#sig_trab").on("input", function() {
        var trabajaValue = $(this).val();
    
        if (trabajaValue === "no") {
            $('#cont_fec_sali').css("display", "block"); 
        } else {
            $('#cont_fec_sali').css("display", "none"); 
        }
    });

    $("#sig_trab_2").on("input", function() {
        var trabajaValue = $(this).val();
    
        if (trabajaValue === "no") {
            $('#cont_fec_sali_2').css("display", "block"); 
        } else {
            $('#cont_fec_sali_2').css("display", "none"); 
        }
    });

    $("#tiempo_fin_1").prop("disabled", true);
    $("#sigo_estu").prop("disabled", true);

    $("#culm_aca").on("input", function() {
        var culmiValue = $(this).val();
    
        if (culmiValue === "no") {
            $("#tiempo_fin_1").val("");
            $("#tiempo_fin_1").prop("disabled", true);
            $('#cont_fec_fin_est').css("display", "none");
        } else {
            $("#tiempo_fin_1").prop("disabled", false);
            $('#cont_fec_fin_est').css("display", "block");
        }
    });
    
    $("#culm_aca").on("input", function() {
        var culmiValue = $(this).val();
    
        if (culmiValue === "si" || culmiValue === "--" ) {
            $("#sigo_estu").val("");
            $("#sigo_estu").prop("disabled", true);
            $('#cont_check_fin_est').css("display", "none");
        } else {
            $("#sigo_estu").prop("disabled", false);
            $('#cont_check_fin_est').css("display", "block");
        }
    });

    $("#tiempo_fin_2").prop("disabled", true);
    $("#sigo_estu_2").prop("disabled", true);

    $("#culm_aca_2").on("input", function() {

        var culmiValue2 = $(this).val();
    
        if (culmiValue2 === "no" || culmiValue2 === "--" ) {
            $("#tiempo_fin_2").val("");
            $("#tiempo_fin_2").prop("disabled", true);
            $('#cont_fec_fin_est_2').css("display", "none");
        } else {
            $("#tiempo_fin_2").prop("disabled", false);
            $('#cont_fec_fin_est_2').css("display", "block");
        }
    });
    
    $("#culm_aca_2").on("input", function() {
        var culmiValue2 = $(this).val();
    
        if (culmiValue2 === "si" || culmiValue2 === "--" ) {
            $("#sigo_estu_2").val("");
            $("#sigo_estu_2").prop("disabled", true);
            $('#cont_check_fin_est_2').css("display", "none");
        } else {
            $("#sigo_estu_2").prop("disabled", false);
            $('#cont_check_fin_est_2').css("display", "block");
        }
    });
		
	const passwordInput = document.getElementById('contrasena');
    const passwordInput2 = document.getElementById('conf_contrasena');

    $('#btn_ver_cont').on('click', function(e) {
        e.preventDefault();
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            $('#btn_ver_cont').html('<img src="../img/registro 1/ojo_cerrado.svg" alt="">');
        } else {
            passwordInput.type = 'password';
            $('#btn_ver_cont').html('<img src="../img/registro 1/ojo_abierto.svg" alt="">');
        }
    });

    $('#btn_ver_cont_conf').on('click', function(e) {
        e.preventDefault();
        if (passwordInput2.type === 'password') {
            passwordInput2.type = 'text';
            $('#btn_ver_cont_conf').html('<img src="../img/registro 1/ojo_cerrado.svg" alt="">');
        } else {
            passwordInput2.type = 'password';
            $('#btn_ver_cont_conf').html('<img src="../img/registro 1/ojo_abierto.svg" alt="">');
        }
    });

    // ***************************************************************************************************** //
    // ******************************** FORMULARIO REGISTRO EMPRESA **************************************** //
    // ***************************************************************************************************** //
    
    $(document).on('submit','#cuerpo_registro_emp',function (e) {
        e.preventDefault();
        let form = $(this);
        let token_emp = document.getElementById("token_invi").value;
        let valorToken = document.getElementById("contDeToken").value;
        var codigo_pin_empre = token_emp; 
        var frmDATA = new FormData;

        var archivo_foto_emp            = $('#archivo_foto_emp',form).prop('files')[0];
        var razon_social                = $('#razon_social',form).val();
        var nit                         = $('#nit',form).val();
        var contacto_area_emp           = $('#contacto_area_emp',form).val();

        var departamento_emp            = $('#departamento_emp',form).val();
		var municipios_emp              = $('#municipios_emp',form).val();
        var correo_emp                  = $('#correo_emp',form).val();
        var celular_emp                 = $('#celular_emp',form).val();
        var contrasena_emp              = $('#contrasena_emp',form).val();
        var confir_contrasena_emp       = $('#confir_contrasena_emp',form).val();
        var direccion_emp               = $('#direccion_emp',form).val();

        var mision_emp                  = $('#mision_emp',form).val();
        var vision_emp                  = $('#vision_emp',form).val();

        var archivo_logo                = $('#archivo_logo',form).prop('files')[0];

        frmDATA.append('archivo_foto_emp',archivo_foto_emp);
        frmDATA.append('razon_social',razon_social);
        frmDATA.append('nit',nit);
        frmDATA.append('contacto_area_emp',contacto_area_emp);

        frmDATA.append('celular_emp',celular_emp);
        frmDATA.append('correo_emp',correo_emp);
        frmDATA.append('contrasena_emp',contrasena_emp);
        frmDATA.append('confir_contrasena_emp',confir_contrasena_emp);
        frmDATA.append('departamento_emp',departamento_emp);
        frmDATA.append('municipios_emp',municipios_emp);
        frmDATA.append('direccion_emp',direccion_emp);

        frmDATA.append('mision_emp',mision_emp);
        frmDATA.append('vision_emp',vision_emp);

        frmDATA.append('archivo_logo',archivo_logo);
        
        console.log(valorToken);
        console.log(codigo_pin_empre);

        if (valorToken === codigo_pin_empre) {
            // Mostrar ventana emergente de carga
            Swal.fire({
                title: 'Registrando...',
                text: 'Por favor espera mientras procesamos tu inscripción.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
        
            const url_emp = "../controlador/controlador_registrar_usuario_empresas.php";
            $.ajax({
                type: "post",
                url: url_emp,
                data: frmDATA,
                contentType: false,
                processData: false,
                dataType: "json",
                async: true
            })
            .done(function ajaxDone(res) {
                Swal.close();  // Cerrar la ventana emergente de carga cuando la solicitud haya terminado
        
                if (res.error !== undefined) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la inscripción',
                        text: res.error
                    });
                }
        
                if (res.mensaje !== undefined) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        text: 'Tu inscripción se ha completado con éxito.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = res.url;  // Redirigir después del éxito
                    });
                }
            })
            .fail(function ajaxFailed(e) {
                Swal.close();  // Cerrar la ventana emergente de carga en caso de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema con la inscripción. Por favor intenta de nuevo.'
                });
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Código incorrecto',
                text: 'El código de confirmación es incorrecto. Por favor, inténtalo nuevamente.'
            });
        }
        
    });

    $('#btn_env_emp').click(function (e) { 
        e.preventDefault();
        let msg = "";
        data_form_emp = {
            archivo_foto_emp:          $('#archivo_foto_emp').val(),
            razon_social:              $('#razon_social').val(),
            nit:                       $('#nit').val(),
            contacto_area_emp:         $('#contacto_area_emp').val(),

            departamento_emp:          $('#departamento_emp').val(),
            municipios_emp:            $('#municipios_emp').val(),
            correo_emp:                $('#correo_emp').val(),
			correo_emp_conf:           $('#correo_emp_conf').val(),
            contrasena_emp:            $('#contrasena_emp').val(),
            confir_contrasena_emp:     $('#confir_contrasena_emp').val(),
            direccion_emp:             $('#direccion_emp').val(),
            celular_emp:               $('#celular_emp').val(),

            mision_emp:                $('#mision_emp').val(),
            vision_emp:                $('#vision_emp').val(),

            archivo_logo:              $('#archivo_logo').val(),
            tipo:                       "E"
        };

        //VALIDACION DE DATOS
        //Validacion informacion general
		
		var extPermitidas = /(.png|.gif|.jpg|.jpeg|.PNG|.GIF|.JPG|.JPEG)$/i;

        if( data_form_emp.archivo_foto_emp.length !== 0) {
            var filename = $('#archivo_foto_emp').val().replace(/C:\\fakepath\\/i, '')
            var valor = data_form_emp.archivo_foto_emp;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo:  "+filename+"  NO PERMITIDO <br>";
            }
        }
		
        if( data_form_emp.archivo_logo.length !== 0) {
            var filename = $('#archivo_logo').val().replace(/C:\\fakepath\\/i, '')
            var valor = data_form_emp.archivo_logo;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        data_form_emp.archivo_logo.length == 0 ? msg += "- Debe ingresar Logo de su empresa <br>" : "" ;
        data_form_emp.archivo_foto_emp.length == 0 ? msg += "- Debe ingresar una foto decorativa <br>" : "" ;

        data_form_emp.razon_social.length == 0 ? msg += "- Es necesario ingresar una razon social <br>" : "";
        data_form_emp.nit.length == 0 ? msg += "- Debe ingresar un numero NIT <br>" : "";
        (data_form_emp.contacto_area_emp.length == 0 || data_form_emp.contacto_area_emp.length > 400) ? msg += "- Ingrese una descripción menor a 400 caracteres <br>" : "";
        // Validacion informacion de contacto
        (data_form_emp.celular_emp.length <= 0 || data_form_emp.celular_emp.length > 10) ? msg += "- Ingrese un numero de telefono valido <br>" : "";
        validacion_letra(data_form_emp.celular_emp) ? msg += "- El numero de telefono no puede tener letras <br>" : "";
        data_form_emp.correo_emp.length == 0 ? msg += "- Ingrese un correo electronico <br>" : "";
		(data_form_emp.correo_emp !== data_form_emp.correo_emp_conf) ? msg += "- los correos electronicos deben ser iguales <br>" : "";
        data_form_emp.contrasena_emp.length == 0 ? msg += "- Debe ingresar una contraseña <br>": "";
        (data_form_emp.contrasena_emp !== data_form_emp.confir_contrasena_emp) ? msg += "- La contraseña debe ser igual <br>" : "";
        data_form_emp.departamento_emp == null ? msg += "- Ingrese el departamento donde estan ubicados <br>" : "";
        data_form_emp.municipios_emp == null ? msg += "- Ingrese el municipios donde estan ubicados <br>" : "";
        data_form_emp.direccion_emp.length == 0 ? msg += "- Debe colocar una dirección <br>" : " ";
        data_form_emp.mision_emp.length == 0 ? msg += "- Se debe tene una misión <br>" : "";
        data_form_emp.vision_emp.length == 0 ? msg += "- Se debe tene una visións" : "";

        if (msg !== "") {
            $('#cont_error_emp').show();
            $('#cont_msg_emp').html(msg);
        }

        if (msg == "") {
            const url_token = "../controlador/controlador_token.php";
            var codigo_pin_emp = generarAleatorios(8);

            // Mostrar ventana emergente de carga
            Swal.fire({
                title: 'Enviando PIN...',
                text: 'Por favor espera mientras se envía el PIN de verificación.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "POST",
                url: url_token,
                data: {nombre: data_form_emp.razon_social, token: codigo_pin_emp, correo: data_form_emp.correo_emp, tipo: data_form_emp.tipo},
                dataType: "json",
                async: true
            })
            .done(function ajaxDone(res){
                
                Swal.close();  // Cerrar la ventana emergente de carga cuando la solicitud haya terminado

                if (res.error !== undefined) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la inscripción',
                        text: res.error
                    });
                }

                if (res.mensaje !== undefined) {
                    $('#Cont_token').show();
                    $('#invisible').html(res.mensaje);
                    $('#btn_can_token').click(function (e) { 
                        e.preventDefault();
                        $('#Cont_token').hide();
                    });
                }
            });
        } 
    });
		
	const passwordInputEmp = document.getElementById('contrasena_emp');
    const passwordInputEmp2 = document.getElementById('confir_contrasena_emp');

    $('#btn_ver_cont_emp').on('click', function(e) {
        e.preventDefault();
        if (passwordInputEmp.type === 'password') {
            passwordInputEmp.type = 'text';
            $('#btn_ver_cont_emp').html('<img src="../img/registro 1/ojo_cerrado.jpg" alt="">');
        } else {
            passwordInputEmp.type = 'password';
            $('#btn_ver_cont_emp').html('<img src="../img/registro 1/ojo_abierto.jpg" alt="">');
        }
    });

    $('#btn_ver_cont_conf_emp').on('click', function(e) {
        e.preventDefault();
        if (passwordInputEmp2.type === 'password') {
            passwordInputEmp2.type = 'text';
            $('#btn_ver_cont_conf_emp').html('<img src="../img/registro 1/ojo_cerrado.jpg" alt="">');
        } else {
            passwordInputEmp2.type = 'password';
            $('#btn_ver_cont_conf_emp').html('<img src="../img/registro 1/ojo_abierto.jpg" alt="">');
        }
    });

    // ***************************************************************************************************** //
    // ********************************** FORMULARIO NUEVA VACANTE **************************************** //
    // ***************************************************************************************************** //
    
    $(document).on('submit','#form_vacante',function(e) { 
        e.preventDefault();
        let msg = "";
        let form = $(this);

        data_form_vac = {
            nom_vacante:            $('#nom_vacante',form).val(),
            des_vacante:            $('#des_vacante',form).val(),
            sal_vacante:            $('#sal_vacante',form).val(),
            departamento_vac:       $('#departamento_vac',form).val(),
            municipios_vac:         $('#municipios_vac',form).val(),
        }
        
        // Validar datos
        data_form_vac.nom_vacante == null ? msg += "- Debe ingresar un nombre adecuado para una vacante <br>" : "";
        data_form_vac.des_vacante.length == 0 ? msg += "- Ingrese una descripcion para la vacante <br>" : "";
        data_form_vac.sal_vacante.length == 0 ? msg += "- Ingrese una cantidad de salario de vacante <br>" : "";
        data_form_vac.departamento_vac == null ? msg += "- Ingrese departamento de vacante <br>" : "";
        data_form_vac.municipios_vac == null ? msg += "- Ingrese municipio de vacante <br>" : "";
        validacion_letra(data_form_vac.sal_vacante) ? msg += "- El salario no puede contener letras" : "";

        if (msg !== "") {
            $('#contGlobal').show();
            $('#cuerpoInt').html(msg);
            $('#btn_aceptar').hide();
            $('#btn_fallo').click(function (e) { 
                e.preventDefault();
                $('#contGlobal').hide();
            });
        }

        if (msg == "") {
            const url_vac = "../../controlador/controlador_registrar_vacantes.php";
            $.ajax({
                type: "post",
                url: url_vac,
                data: data_form_vac,
                dataType: "json",
                async: true
            })
            .done(function ajaxDone(res){
                if (res.error !== undefined) {
                    $('#contGlobal').show();
                    $('#cuerpoInt').html(res.error);
                    $('#btn_aceptar').hide();
                    $('#btn_fallo').click(function (e) { 
                        e.preventDefault();
                        $('#contGlobal').hide();
                    });
                }

                if (res.mensaje !== undefined) {
                    $('#contGlobal').show();
                    $('#cuerpoInt').html(res.mensaje);
                    $('#btn_fallo').hide();
                    $('#btn_aceptar').click(function (e) { 
                        e.preventDefault();
                        $('#contGlobal').hide();
                        location.reload();
                    });
                }
            });    
        }
    });

    $(document).on('click', '.btn_edi', function (e) {
        e.preventDefault();
        var objeto = {};
        let v = this.value;
        objeto['vacante'] = v;
        let url = "../../obtener_datos/empresa/obtener_vacantes.php";
        $.ajax({
            type: "post",
            url: url,
            data: objeto,
            dataType: "json",
            async: true
        })
        .done(function ajaxDone(res) {
            (res.error !== undefined) ? mostrarError(res.error) : "";
            (res.mensaje !== undefined) ? mostrarFormularioEdicion(res) : "";
        });
    });
		
	function mostrarError(error) {
        $('#contGlobal').show();
        $('#cuerpoInt').html(error);
        $('#btn_aceptar').hide();
        $('#btn_fallo').click(function (e) { 
            e.preventDefault();
            $('#contGlobal').hide();
        });
    }
    
    function mostrarFormularioEdicion(res) {

        const opcionesCargo     = generarOpcionesSelectCar(res.mensaje[0].nom_vacante, ['VIGILANTE DE SEGURIDAD', 'SUPERVISOR DE SEGURIDAD', 'ESCOLTA', 'OPERADOR DE MEDIOS TECNOLÓGICOS']);
        const departamentos     = generarOpcionesSelectDep(res.mensaje[0].cod_dep, res.departamentos.map(element => element));
        const municipios        = generarOpcionesSelectMun(res.mensaje[0].cod_mun, res.municipios.map(element => element));
        const valorBaseDatos = res.mensaje[0]['estado'];

        $('#cuerpoIntEdit').html(`
            <div>
                <h3>OFERTA A EDITAR</h3>
                <select name="" id="nom_vacante_edi" class="input">
                    <option value="" disabled >Cargo</option>
                    ${opcionesCargo}
                </select>
                <textarea name="" id="des_vacante_edi" cols="30" rows="10" class="input" placeholder="Descripcion de la vacante">${res.mensaje[0].descripcion}</textarea>
                <input type="number" value="${res.mensaje[0].salario}" name="" id="sal_vacante_edi" class="input" placeholder="Salario de la vacante">
                <select class="input" id="departamento_vacante_edi">
                    <option value="" disabled selected>Departamento</option>
                    ${departamentos}
                </select>
                <select class="input" id="municipio_vacante_edi">
                    <option value="" disabled selected>Municipio</option>
                    ${municipios}
                </select>
                <input type="hidden" id="oculto_inp" value="${res.mensaje[0].id_vacante}">
                <div class="check_btn">
                    <label for="oculto_inp">Ocultar esta convocatoria para los posibles candidatos</label>
                    <div class="wrap-toggle">
                        <input type="checkbox" id="toggle" class="offscreen">
                        <label for="toggle" class="swith"></label>
                    </div>
                </div>
            </div>                
        `);

        if (valorBaseDatos == 0) {
            $('#toggle').prop('checked',true);
        } else {
            console.log("llegando a 1");
            $('#toggle').prop('checked',false);
        }
    
        $('#contEdit').show();
    }
    
    function generarOpcionesSelectDep(valorActual, opciones) {
        return opciones.map(option => {
            const { cod_dep, departamento } = option; // Desestructura el objeto para obtener cod_dep y nombre_dep
            const selected = cod_dep === valorActual ? 'selected' : '';
            return `<option value="${cod_dep}" ${selected}>${departamento}</option>`;
        }).join('');
    }

    function generarOpcionesSelectMun(valorActual, opciones) {
        return opciones.map(optionValue => {
            const { cod_mun, municipio } = optionValue; // Desestructura el objeto para obtener cod_dep y nombre_dep
            const selected = cod_mun === valorActual ? 'selected' : '';
            return `<option value="${cod_mun}" ${selected}>${municipio}</option>`;
        }).join('');
    }

    function generarOpcionesSelectCar(valorActual, opciones) {
        return opciones.map(optionvalue => {
            const selected = optionvalue === valorActual ? 'selected' : '';
            return `<option value="${optionvalue}" ${selected}>${optionvalue}</option>`;
        }).join('');
    }

    $(document).on('submit','#form_act_vac',function (e) { 
        e.preventDefault();
        var msg = "";
        
        var data_form = {
            oculto_inp:                     $('#oculto_inp').val(),
            nom_vacante_edi:                $('#nom_vacante_edi').val(),
            des_vacante_edi:                $('#des_vacante_edi').val(),
            sal_vacante_edi:                $('#sal_vacante_edi').val(),
            departamento_vacante_edi:       $('#departamento_vacante_edi').val(),
            municipio_vacante_edi:          $('#municipio_vacante_edi').val(),
            estado:                         $('#toggle').prop('checked')
        }

        console.log(data_form);

        (data_form.nom_vacante_edi == "" || data_form.nom_vacante_edi == null) ? msg += "El cargo de la vacante de encuentra vacio <br>" : ""; 
        (data_form.des_vacante_edi == "" || data_form.des_vacante_edi == null) ? msg += "La descripcion de la vacante de encuentra vacio <br>" : "";
        (data_form.sal_vacante_edi == "" || data_form.sal_vacante_edi == null) ? msg += "El sueldo de la vacante de encuentra vacio <br>" : "";
        (data_form.departamento_vacante_edi == "" || data_form.departamento_vacante_edi == null) ? msg += "El departamento de la vacante de encuentra vacio <br>" : "";
        (data_form.municipio_vacante_edi == "" || data_form.municipio_vacante_edi == null) ? msg += "El municipio de la vacante de encuentra vacio <br>" : "";

        if (msg != "") {
            $('#contGlobal').show();
            $('#cuerpoInt').html(msg);
            $('#btn_aceptar').hide();
            $('#btn_fallo').click(function (e) { 
                e.preventDefault();
                $('#contGlobal').hide();
            });
        }

        if (msg == "") {
            url = "../../actualizacion_datos/empresa/actualizacion_vacante.php";
            $.ajax({
                type: "post",
                url: url,
                data: data_form,
                dataType: "json",
                async: true
            })
            .done(function ajaxDone(res){

                if (res.error !== undefined) {
                }

                if (res.mensaje !== undefined) {
                    location.reload();
                }

            });   
        }
    });
		
	let url_estado = "../../controlador/controlador_estado.php";

    $('.estado').change(function() {
        if ($(this).is(':checked')) {
            $('.estado_des').text('Trabajando');
            $('.estado').prop('checked',true);
            let estado = $('#estado').prop('checked');
            $.ajax({
                type: "POST",
                url: url_estado,
                data: { estado: estado },
                dataType: "json",
                success: function (res) {
                    res.error !== undefined ? alert(res.error) : "";
                    res.mensaje !== undefined ? alert(res.mensaje) : "";
                }
            });

        } else {
            $('.estado_des').text('Desempleado(a)');
            $('.estado').prop('checked',false);
            let estado = $('#estado').prop('checked');
            $.ajax({
                type: "POST",
                url: url_estado,
                data: { estado: estado },
                dataType: "json",
                success: function (res) {
                    res.error !== undefined ? alert(res.error) : "";
                    res.mensaje !== undefined ? alert(res.mensaje) : "";
                }
            });
            console.log(estado);
        }
    });

    $('#btn_can_vac').click(function (e) {
        e.preventDefault();
        $('#contEdit').hide();
    });

    $('#btn_eli_vac').click(function (e) { 
        e.preventDefault();
        $('#contEli').show();
    });

    $('#btn_can_eli').click(function (e) { 
        e.preventDefault();
        $('#contEli').hide();
    });

    $('#btn_ace_eli').click(function (e) { 
        e.preventDefault();
        var data = {id_vacante:  $('#oculto_inp').val()}
        
        let url = "../../actualizacion_datos/empresa/eliminar_vacante.php"
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            async: true
        })
        .done(function ajaxDone(res) {

            if (res.error !== undefined) {
                console.log(res.error);
            }

            if (res.mensaje !== undefined) {
                console.log(res.mensaje);
                location.reload();
            }

        })
    });

    // ***************************************************************************************************** //
    // ************************************ FORMULARIO DE LOGIN ******************************************** //
    // ***************************************************************************************************** //
    
    $(document).on('submit','#form_login',function (e) {
        e.preventDefault();

        let msg = "";
        let form = $(this);

        var data_form_log = {
            id_user:            $('#id_user',form).val(),
            cont_user:          $('#cont_user',form).val(),
            rad_us_nat:         $('#rad_us_nat',form).prop('checked'),
            rad_us_emp:         $('#rad_us_emp',form).prop('checked'),
            inp_rec_cred:       $('#inp_rec_cred',form).prop('checked')
        }

        data_form_log.id_user.length == 0 ? msg += "Debe ingresar un numero de usuario <br>" : "";
        validacion_letra(data_form_log.id_user) ? msg += "El usuario no debe tener letras ni caracteres especiales" : "";
        data_form_log.cont_user.length == 0 ? msg += "Debe ingresar una contraseña" : "";

        const url_log = "../controlador/controlador_login.php";

        $.ajax({
            type: "post",
            url: url_log,
            data: data_form_log,
            dataType: "json",
            async: true
        })
        .done(function ajaxDone(res){
            
            if (res.okay !== undefined) {
                if (res.okay_nat == 'n') { 
                    window.location.href = res.url;  
                } else {
                    window.location.href = res.url;    
                }            
            }

            if (res.error !== undefined) {
                $('#contVeEmLo').show();
                $('#cont_msg_VeEmLo').html(res.error);
            }

        });
    });

    $(document).on('submit','#form_login_admin',function (e) {
        e.preventDefault();

        let msg = "";
        let form = $(this);

        var data_form_log = {
            id_user:            $('#id_user',form).val(),
            cont_user:          $('#cont_user',form).val(),
            inp_rec_cred:       $('#inp_rec_cred',form).prop('checked')
        }

        data_form_log.id_user.length == 0 ? msg += "Debe ingresar un usuario <br>" : "";
        data_form_log.cont_user.length == 0 ? msg += "Debe ingresar una contraseña" : "";

        const url_log = "../../controlador/controlador_login_admin.php";

        $.ajax({
            type: "post",
            url: url_log,
            data: data_form_log,
            dataType: "json",
            async: true
        })
        .done(function ajaxDone(res){
            
            if (res.okay !== undefined) {
                if (res.okay_nat == 'n') { 
                    window.location.href = res.url;  
                } else {
                    window.location.href = res.url;    
                }            
            }

            if (res.error !== undefined) {
                $('#contVeEmLo').show();
                $('#cont_msg_VeEmLo').html(res.error);
            }

        });
    });
		
	const passwordLog = document.getElementById('cont_user');

    $('#btn_ver_log').on('click', function(e) {
        e.preventDefault();
        if (passwordLog.type === 'password') {
            passwordLog.type = 'text';
            $('#btn_ver_log').html('<img src="../img/registro 1/ojo_cerrado.svg" alt="">');
        } else {
            passwordLog.type = 'password';
            $('#btn_ver_log').html('<img src="../img/registro 1/ojo_abierto.svg" alt="">');
        }
    });

    // ***************************************************************************************************** //
    // **************************** CARGA DE DATOS PERSONA NATURAL ***************************************** //
    // ***************************************************************************************************** //
    
    $('#archivo').on('change', procesarArchivo);

    function procesarArchivo (event) {
        let imagen = event.target.files[0];
        let lector = new FileReader();
            
        lector.addEventListener('load', mostrarImagen, false);
            
        lector.readAsDataURL(imagen);
    }
    
    function mostrarImagen(event) {
        let imagenSource = event.target.result;
        let previewImage = document.getElementById('preview');
            
        previewImage.src = imagenSource;
    }
    
    $(document).on('click','#per_nat',function (e) {
        e.preventDefault();
        window.location.href="../pages/natural/perfil_natural.php";
    });
    

    // ***************************************************************************************************** //
    // **************************** CARGA DE DATOS USUARIO EMPRESA ***************************************** //
    // ***************************************************************************************************** //
    $('#archivo_foto_emp').on('change', procesarArchivoFoto);
    $('#archivo_logo').on('change', procesarArchivoLogo);

    function procesarArchivoFoto (event) {
        let imagen =event.target.files[0];
        let lector = new FileReader();
    
        lector.addEventListener('load', mostrarImagenEmp, false);
    
        lector.readAsDataURL(imagen);
    }
    
    function mostrarImagenEmp(event) {
        let imagenSource = event.target.result;
        let previewImage = document.getElementById('preview_emp');
    
        previewImage.src = imagenSource;
    } 
    
    function procesarArchivoLogo (event) {
        let imagen = event.target.files[0];
        let lector = new FileReader();
    
        lector.addEventListener('load', mostrarImagenLogo, false);
    
        lector.readAsDataURL(imagen);
    }      
    
    function mostrarImagenLogo(event) {
        let imagenSource = event.target.result;
        let previewImage = document.getElementById('preview_logo_emp');
    
        previewImage.src = imagenSource;
    }
    
    $('#btn_tus_ofertas').click(function (e) { 
        e.preventDefault();
        mover_izq();
        function mover_izq() {
            ul_inf.style.marginLeft = "0";
            ul_inf.style.transition = "1s";
        }
    });

    $('#btn_new_ofer').click(function (e) { 
        e.preventDefault();
        mover_der();
        function mover_der() {
            ul_inf.style.marginLeft = "-100%";
            ul_inf.style.transition = "1s";
        }
    });
    
    $(document).on('click','.btn_car',function (e) { 
        e.preventDefault();
        var objeto = {};
        let x = "#cont_aspi" + this.value;  // contenedor conocer aspirantes
        let v = this.value;                 // Valor de boton de conocer aspirantes
        let m = "#btn_car" + v;             // Boton de conocer aspirantes
        objeto['vacante'] = v;
        var $boton = $(m);
        let url_ob_asp = "../../obtener_datos/empresa/obtener_aspirante.php";
        $.ajax({
            type: "post",
            url: url_ob_asp,
            data: objeto,
            dataType: "json",
            async: true
        })
        .done(function ajaxDone(res){
            var plantilla = '<div class="cont_ap">';
            if (res.datos.length > 0) {
                res.datos.forEach(dato=> {
                    plantilla += `
                    <div class="cont_ap_dato">
                        <div class="cont_des_nom_car">
                            <p id="nom_aspi"> `+ dato.pri_nom + ' ' + dato.seg_nom + ' ' + dato.pri_ape + ' ' + dato.seg_ape +`</p>
                            <p id="cedula_aspi">`+ dato.tip_doc + ': ' + dato.num_doc +`</p>
                        </div>
                        <div class="cont_des_button">
                            <button class="btn_cono_aspi" id="btn_cono_aspi` + dato.id_vac +  dato.num_doc + `" value="` + dato.id_vac + "/" + dato.num_doc +`">
                                CONOCER MÁS
                            </button>
                        </div>    
                    </div>
                    <div class="cont_perfil" id="con_inf_ge`+ dato.id_vac + dato.num_doc +`" style="display: none">
                        
                    </div>
                    `;
                });
            } else {
                    plantilla += `
                    <div class="cont_ap_erro">
                        <p>***** NO SE ENCUENTRAN ASPIRANTES REGISTRADOS EN ESTA VACANTE *****</p>
                    </div>`;
            }
            plantilla += '</div>';
            $(x).html(plantilla);
            $(x).toggle(1, function() {
                $boton.text($(this).is(':visible')
                ? 'MOSTAR MENOS'
                : 'CONOCER ASPIRANTES');
            });
        });
    });

    $(document).on('click', '.btn_cono_aspi',function (e) { 
        e.preventDefault();
        var objeto = {}; // Objeto para el array
        var datos = this.value.split('/');
        objeto['vacante']      = datos[0];
        objeto['id_user']      = datos[1];
        let x = "#con_inf_ge" + objeto['vacante'] + objeto['id_user']; // contenedor a mostar
        let m = "#btn_cono_aspi" + objeto['vacante'] + objeto['id_user']; // boton para que realiza la accion
        var $boton = $(m);
        let url_ob_asp_inf = "../../obtener_datos/empresa/obtener_asp_prof.php";
        $.ajax({
            type: "post",
            url: url_ob_asp_inf,
            data: objeto,
            dataType: "json",
            async: true
        })
        .done(function ajaxDone(res){
            var plantilla = '';
            if (res.datos.length > 0) {
                res.datos.forEach(dato=> {
                    plantilla += `
                    <div class="cont_inf_perf">
                        <div class="foto_user_nat">
                            <img src="../` + dato.foto + `" alt="foto usuario natural">
                        </div>
                        <div class="inf_aspi">
                            <p class="nom_aspi">`+ dato.pri_nom + ' ' + dato.seg_nom + ' ' + dato.pri_ape + ' ' + dato.seg_ape +`</p>
                            <p class="cedula_aspi">`+ dato.tip_doc + ': ' + dato.num_doc +`</p>
                            <p class="correo">Correo: `+ dato.correo +`</p>
                            <p class="edad">Edad: `+ dato.edad +`</p>
                            <p class="edad">Telefono: `+ dato.telefono +`</p>
                        </div>
                    </div>
                    <div class="btn_cono_mas">
                        <button class="btn_cono_perf" value="` + dato.num_doc + `">
                                Ver perfil
                        </button>
                    </div>
                    `;
                });
            }
            $(x).html(plantilla);
            $(x).toggle(500, function() {
                $boton.text($(this).is(':visible')
                ? 'MOSTAR MENOS'
                : 'CONOCER MÁS');
            });
        });
    });

    $(document).on('click', '.btn_cono_perf', function (e) {
        e.preventDefault();
        var v = this.value;
        const url_nat = "../empresa/perfil_natural_empresa.php?num_doc=" + v;
        window.location.href = url_nat;
    });

    $('#btn_pub_of').click(function (e) { 
        e.preventDefault();
        window.location.href = "../empresa/perfil_empresa.php?process='' #sec_ofer";
    });

    $('#btnPerfil').click(function (e) { 
        e.preventDefault();
        window.location.href = "../empresa/perfil_empresa.php";
    });

    $('#btnPerfil2').click(function (e) { 
        e.preventDefault();
        window.location.href = "../empresa/perfil_empresa.php";
    });

    $('#btn_conf_perf').click(function (e) { 
        e.preventDefault();
        window.location.href = "../pages/empresa/perfil_empresa.php?process=edi_per";
    });

    // ***************************************************************************************************** //
    // ********************************* VACANTES DISPONIBLES ********************************************** //
    // ***************************************************************************************************** //
    var currentPage = 1;
    const url_vac_fil = "../obtener_datos/obtener_filtro_vac.php";
    const url_vac_fil_per = "../../obtener_datos/obtener_filtro_vac_per.php";
    $(document).on('click', '.btn_mas' , function (e) {
        e.preventDefault();
        var v = this.value;             // obtenencion del valor
        let m = '#btn_mas' + v;         // Para cada boton
        let x = '#container_des' + v;   // Contenedor de oferta 
        var $boton = $(m);
        $(x).toggle(1, function() {
            $boton.text($(this).is(':visible')
            ? 'MOSTRAR MENOS'
            : 'MOSTRAR MÁS');
        });
    });
		
	$(document).on('submit','#form_cons_vac', function(event) {
		event.preventDefault();

		var cargo           = $('#vac_cargo').val();
		var municipio       = $('#municipios').val();
		var departamento    = $('#departamento').val();
		var empresa         = $('#nom_empresas').val();

		currentPage = 1; 
		getVacantes(currentPage, cargo , municipio , departamento , empresa);
    });

    function getVacantes(page , cargo , municipio , departamento , empresa) {
        $.ajax({
            url: url_vac_fil,
            type: 'GET',
            data: { page: page, cargo: cargo, municipio: municipio, departamento: departamento, empresa: empresa },
            dataType: 'json',
            success: function ajaxDone(res){
                $('#cont_vac').empty();
                var plantilla = '';
                if (res.datos.length > 0) {
                    res.datos.forEach(dato=> {
                        plantilla += `
                        <div class="container_bus">
                            <div class="img_bus">
                                <img src="` + dato.log_emp + `" alt="logo_empresa">
                            </div>
                            <div class="nom_car_bus">
                                <p id="nom_empresa"><b>` + dato.nom_emp +`</b></p>  
                                <p id="cargo_empresa">` + dato.nom_vac +`</p>
                                <p id="cargo_empresa">` + dato.salario +`</p>
                                <p id="ubicacion"><b>` + dato.municipio + `</b></p>
                            </div>
                            <div>
                                <button id="btn_mas` + dato.id_vac +`" class="btn_mas" value="` + dato.id_vac +`">MOSTRAR MÁS</button>
                            </div>
                        </div>

                        <div class="container_des" id="container_des` + dato.id_vac + `">
                            <div class="cont_des_nom_car">
                                <p id="cargo_empresa"><b>` + dato.nom_emp + `</b></p>
                                <img src="` + dato.log_emp + `" alt="logo_empresa">
                                <p id="ubicacion"><b>` + dato.municipio + `</b></p>
                            </div>
                            <div class="cont_des_des">
                                <p id="descripcion">
                                    ` + dato.descrip + `
                                </p>
                            </div>
                            <div class="cont_des_conocer_mas">
                                <img src="`+ dato.log_emp +`" alt="logo_empresa">
                                <button class="inf_empresa" id="inf_empresa" value="` + dato.id_emp + `">
                                    ¡SABER MÁS!
                                </button>
                                <button id="btn_postular` + dato.id_vac + `" value="` + dato.id_vac + `/` + dato.id_emp + `" class="btn_postular">
                                    POSTULARME
                                </button>
                            </div>
                        </div>
                        <br>
                        `;
                    });
                    $('#cont_vac').fadeOut(200, function() {
                        $(this).fadeIn(10);
                    });
                } else {
                    plantilla += `<h2>**** NO SE ENCUENTRAN VACANTES ****</h2>`;
                }
                $("#cont_vac").html(plantilla);
            }
        });
    }   

    $(document).on('submit','#formBus', function (e) {
        e.preventDefault();

        let cargo           = $("#cargo").val();
        let departamento    = $("#departamento_bus").val();
        let municipio       = $("#municipios_bus").val();

        window.location.href="../pages/vacantes.php?departamento=" + departamento + "&municipio=" + municipio + "&cargo=" + cargo;
    });

    $(document).on('submit','#formBusNat', function (e) {
        e.preventDefault();

        let cargo           = $("#cargo").val();
        let departamento    = $("#departamento_bus").val();
        let municipio       = $("#municipios_bus").val();

        window.location.href="../natural/vacantes.php?departamento=" + departamento + "&municipio=" + municipio + "&cargo=" + cargo;
    });
		
	$(document).on('submit','#form_cons_vac_per', function(event) {
        event.preventDefault();

        var cargo           = $('#vac_cargo').val();
        var municipio       = $('#municipios').val();
        var departamento    = $('#departamento').val();
        var empresa         = $('#nom_empresas').val();
        
        currentPage = 1; 
        getVacantesPer(currentPage, cargo, municipio, departamento, empresa);
    });

    $('#btn_ant').on('click', function() {
        if (currentPage > 1) {
            currentPage--;
            getVacantes(currentPage);
        }
    });

    $('#btn_sig').on('click', function() {
        currentPage++;
        getVacantes(currentPage);
    });

    function getVacantesPer(page, cargo, municipio, departamento, empresa) {
        $.ajax({
            url: url_vac_fil_per,
            type: 'GET',
            data: { page: page, cargo: cargo, municipio: municipio, departamento: departamento, empresa: empresa },
            dataType: 'json',
            success: function ajaxDone(res){
                $('#cont_vac').empty();
                var plantilla = '';
                if (res.datos.length > 0) {
                    res.datos.forEach(dato=> {
                        plantilla += `
                        <div class="container_bus">
                            <div class="img_bus">
                                <img src="../` + dato.log_emp + `" alt="logo_empresa">
                            </div>
                            <div class="nom_car_bus">
                                <p id="nom_empresa"><b>` + dato.nom_emp +`</b></p>  
                                <p id="cargo_empresa">` + dato.nom_vac +`</p>
                                <p id="cargo_empresa">` + dato.salario +`</p>
                                <p id="ubicacion"><b>` + dato.vac_mun + `</b></p>
                            </div>
                            <div>
                                <button id="btn_mas` + dato.id_vac +`" class="btn_mas" value="` + dato.id_vac +`">MOSTRAR MÁS</button>
                            </div>
                        </div>

                        <div class="container_des" id="container_des` + dato.id_vac + `">
                            <div class="cont_des_nom_car">
                                <p id="cargo_empresa"><b>` + dato.nom_emp + `</b></p>
                                <img src="../` + dato.log_emp + `" alt="logo_empresa">
                                <p id="ubicacion"><b>` + dato.vac_mun + `</b></p>
                            </div>
                            <div class="cont_des_des">
                                <p id="descripcion">
                                    ` + dato.descrip + `
                                </p>
                            </div>
                            <div class="cont_des_conocer_mas">
                                <img src="../`+ dato.log_emp +`" alt="logo_empresa">
                                <button class="inf_empresa" id="inf_empresa" value="` + dato.id_emp + `">
                                    ¡SABER MÁS!
                                </button>
                                <button id="btn_postular` + dato.id_vac + `" value="` + dato.id_vac + `/` + dato.id_emp + `" class="btn_postular">
                                    POSTULARME
                                </button>
                            </div>
                        </div>
                        <br>
                        `;
                    });
                    $('#cont_vac').fadeOut(200, function() {
                        $(this).fadeIn(10);
                    });
                } else {
                    plantilla += `<h2>**** NO SE ENCUENTRAN VACANTES ****</h2>`;
                }
                $("#cont_vac").html(plantilla);
            }
        });
    } 

    $('#btn_ant_per').on('click', function() {
        if (currentPage > 1) {
            currentPage--;
            getVacantesPer(currentPage);
        }
    });

    $('#btn_sig_per').on('click', function() {
        currentPage++;
        getVacantesPer(currentPage);
    });

    $(document).on('click','.inf_empresa', function (e) {
        e.preventDefault();
        var v =  this.value;
        const url_emp = "../natural/perfil_empresa_natural.php?id_emp=" + v;
        window.location.href = url_emp;
    });
		
	$(document).on('click','.inf_empresa_ind', function (e) {
        e.preventDefault();
        var v =  this.value;
        const url_emp = "./natural/perfil_empresa_natural.php?id_emp=" + v;
        window.location.href = url_emp;
    });

    // ***************************************************************************************************** //
    // ********************************* POSTULACION A VACANTES ******************************************** //
    // ***************************************************************************************************** //
    $(document).on('click','.btn_postular', function (e) {
        e.preventDefault();
        var objeto = {};
        var datos = this.value.split('/');
        objeto['id_vac']      = datos[0];
        objeto['id_emp']      = datos[1];
        let m = '#btn_postular' + objeto['id_vac'];
        let url_apl = "../../obtener_datos/aplicacion_vac.php"
        $.ajax({
            type: "POST",
            url: url_apl,
            data: objeto,
            dataType: "json",
            async: true
        })
        .done(function ajaxDone(res){
            if (res.error !== undefined) {
                $('#contMsg').show();
                $('#contMsgVacM').html(res.error);
            }

            if (res.okay) {
                $('#contMsg').show();
                $('#contMsgVacM').html(res.okay);
            }
        });
    });

    // ***************************************************************************************************** //
    // ************************** MODIFICACION DATOS USUARIO NATURAL *************************************** //
    // ***************************************************************************************************** //

    // Cambia de ventanas
    $('#btn_edi_per_nat').click(function (e) { 
        e.preventDefault();
        $('#cuerpo_2').show();
        $('#cuerpo_1').hide();
    });

    // Se definen bariables de cambio
    var archivo_uno = false;
    var inf_gen = false;

    var archivo_doc1 = false;
    var archivo_doc2 = false;
		
	var archivo_cap1 = false;
    var archivo_cap2 = false;

    var archivo_estu1 = false;
    var archivo_estu2 = false;

    var archivo_reflab1 = false;
    var archivo_reflab2 = false;

    var archivo_otro1 = false;
    var archivo_otro2 = false;

    var ref_lab_uno = false;
    var ref_lab_dos = false;

    var for_aca_uno = false;
    var for_aca_dos = false;

    var cua_uno = false;
    var cua_dos = false;
	
	var cap_uno = false;
    var cap_dos = false;
		
	var otr_uno = false;
    var otr_dos = false;

    var ref_per_uno = false;
    var ref_per_dos = false;

    $('#archivo_pn').on('input', function () {
        archivo_uno = true;
    })

    $('#doc_cualifi_pn').on('input', function () {
        archivo_doc1 = true;
    })

    $('#doc_cualifi_2_pn').on('input', function () {
        archivo_doc2 = true;
    })

    $('#doc_capacita_pn').on('input', function () {
        archivo_cap1 = true;
    })

    $('#doc_capacita_2_pn').on('input', function () {
        archivo_cap2 = true;
    })

    $('#comp_stu_pn').on('input', function () {
        archivo_estu1 = true;
    })

    $('#comp_stu_2_pn').on('input', function () {
        archivo_estu2 = true;
    })

    $('#comp_rl_pn').on('input', function () {
        archivo_reflab1 = true;
    })

    $('#comp_rl_2_pn').on('input', function () {
        archivo_reflab2 = true;
    })

    $('#comp_otro_pn').on('input', function () {
        archivo_otro1 = true;
    })

    $('#comp_otro_2_pn').on('input', function () {
        archivo_otro2 = true;
    })

    $('#primer_nombre_pn, #segundo_nombre_pn, #primer_apellido_pn,  #segundo_apellido_pn, #tipo_de_documento_pn, #contacto_area_pn, #direccion_pn, #correo_pn, #celular_cont_pn, #municipio_pn, #departamento_pn').on('input', function () {
        inf_gen = true;
    })

    $('#nombre_empresa_pn, #cargo_pn, #tiempo_ingreso_exp_pn, #y_work_pn, #tip_car_1, #tiempo_salida_1_pn, #jefe_inmediato_pn, #celular_exp_pn, #comp_rl_pn').on('input',function () {
        ref_lab_uno = true;
    })

    $('#nombre_empresa_2_pn, #cargo_2_pn, #tiempo_ingreso_exp_2_pn, #y_work_2_pn,  #tip_car_2, #tiempo_salida_2_pn, #jefe_inmediato_2_pn, #celular_exp_2_pn, #comp_rl_2_pn').on('input', function () {
        ref_lab_dos = true;
    })

    $('#nombre_instituto_pn, #nivel_academico_pn, #titulo_op_pn, #y_stu_pn, #tiempo_fin_1_pn, #comp_stu_pn').on('input',function () {
        for_aca_uno = true;
    })

    $('#nombre_instituto_2_pn, #nivel_academico_2_pn, #titulo_op_2_pn, #y_stu_2_pn, #tiempo_fin_2_pn, #comp_stu_2_pn').on('input',function () {
        for_aca_dos = true;
    })

    $('#lug_capaci_pn, #lug_capacita_pn, #fech_capacita_pn, #doc_capacita_pn').on('input',function () {
        cap_uno = true;
    })

    $('#lug_capaci_2_pn, #lug_capacita_2_pn, #fech_capacita_2_pn, #doc_capacita_2_pn').on('input',function () {
        cap_dos = true;
    })

    $('#lug_cuali_pn, #lug_cualifica_pn, #fech_cualifi_pn, #doc_cualifi_pn').on('input',function () {
        cua_uno = true;
    })

    $('#lug_cuali_2_pn, #lug_cualifica_2_pn, #fech_cualifi_2_pn, #doc_cualifi_2_pn').on('input',function () {
        cua_dos = true;
    })
		
	$('#nom_inst_otro_pn, #tit_op_otro_pn, #tie_fin_otro_1_pn, #comp_otro_pn').on('input',function () {
        otr_uno = true;
    })

    $('#nom_inst_otro_2_pn, #tit_op_otro_2_pn, #tie_fin_otro_2_pn, #comp_otro_2_pn').on('input',function () {
        otr_dos = true;
    })

    $('#nomb_ref_pn, #ape_ref_pn, #car_ref_pn, #cel_ref_pn').on('input',function () {
        ref_per_uno = true;
    })

    $('#nomb_ref_2_pn, #ape_ref_2_pn, #car_ref_2_pn, #cel_ref_2_pn').on('input',function () {
        ref_per_dos = true;
    })

    // Cambio en el input de la foto
    $('#archivo_pn').on('change', procesarArchivoPN);

    function procesarArchivoPN (event) {
        let imagen = event.target.files[0];
        let lector = new FileReader();
    
        lector.addEventListener('load', mostrarImagenPN, false);
    
        lector.readAsDataURL(imagen);
    }
    
    function mostrarImagenPN(event) {
        let imagenSource = event.target.result;
        let previewImage = document.getElementById('preview_pn');
    
        previewImage.src = imagenSource;
    }
		
	// Selecciona todos los elementos con la clase custom-file-input
    $('.custom-file-input').change(function() {
        
        if ($(this).val() == "") {
            $(this).next('.custom-file-label').text('CARGAR CERTIFICADO').css({"background-color": "#dddbd5","border": "0.5px solid: #424242",  "color": "#000"});    
        } else {
            $(this).next('.custom-file-label').text('CERTIFICADO CARGADO').css({"background-color": "#2c3691", "color": "#fff"});    
        }
        
    });

    const selectTrabajo = document.getElementById('y_work_pn');
    const contenedorSalida = document.getElementById('tiempo_salida_container');

    if (selectTrabajo && contenedorSalida) {
        selectTrabajo.addEventListener('change', function () {
            contenedorSalida.style.display = (this.value === 'si') ? 'none' : '';
        });
    }

    const selectTrabajo_2 = document.getElementById('y_work_2_pn');
    const contenedorSalida_2 = document.getElementById('tiempo_salida_container_2');

    if (selectTrabajo_2 && contenedorSalida_2) {
        selectTrabajo_2.addEventListener('change', function () {
            contenedorSalida_2.style.display = (this.value === 'si') ? 'none' : '';
        });
    }

    const selectEstudio = document.getElementById('y_stu_pn');
    const contenedorFin = document.getElementById('tiempo_fin_container');

    const selectEstudio_2 = document.getElementById('y_stu_2_pn');
    const contenedorFin_2 = document.getElementById('tiempo_fin_container_2');

    if (selectEstudio && contenedorFin) {
        selectEstudio.addEventListener('change', function () {
            if (this.value === 'no') {
                contenedorFin.style.display = '';
            } else if (this.value === 'si') {
                contenedorFin.style.display = 'none';
            } else {
                contenedorFin.style.display = '';
            }
        });
    }

    if (selectEstudio_2 && contenedorFin_2) {
        selectEstudio_2.addEventListener('change', function () {
            if (this.value === 'no') {
                contenedorFin_2.style.display = '';
            } else if (this.value === 'si') {
                contenedorFin_2.style.display = 'none';
            } else {
                contenedorFin_2.style.display = '';
            }
        });
    }

    $(document).on('submit',"#form_act",function (e) { 
        e.preventDefault();
        let msg = "";
        var frmDATA = new FormData;
        let form = $(this);

        var archivo_pn                    = $('#archivo_pn',form).prop('files')[0];

        var primer_nombre_pn              = $('#primer_nombre_pn',form).val();
        var segundo_nombre_pn             = $('#segundo_nombre_pn',form).val();
        var primer_apellido_pn            = $('#primer_apellido_pn',form).val();
        var segundo_apellido_pn           = $('#segundo_apellido_pn',form).val();
        var tipo_de_documento_pn          = $('#tipo_de_documento_pn',form).val();
        var cedula_de_ciudadania_pn       = $('#cedula_de_ciudadania_pn',form).val();

        // contact;
        var direccion_pn                  = $('#direccion_pn',form).val();
        var departamento_pn               = $('#departamento_pn',form).val();
        var municipio_pn                  = $('#municipio_pn',form).val();
        var celular_cont_pn               = $('#celular_cont_pn',form).val();
        var correo_pn                     = $('#correo_pn',form).val();
        var contacto_area_pn              = $('#contacto_area_pn',form).val();

        // referencia labora;
        var nombre_empresa_pn             = $('#nombre_empresa_pn',form).val();
        var cargo_pn                      = $('#cargo_pn',form).val();
        var tiempo_ingreso_exp_pn         = $('#tiempo_ingreso_exp_pn',form).val();
        var y_work_pn                     = $('#y_work_pn',form).val();
        var tip_car_1                     = $('#tip_car_1',form).val();
        var tiempo_salida_1_pn            = $('#tiempo_salida_1_pn',form).val();
        var jefe_inmediato_pn             = $('#jefe_inmediato_pn',form).val();
        var celular_exp_pn                = $('#celular_exp_pn',form).val();
        var comp_rl_pn                    = $('#comp_rl_pn',form).prop('files')[0];
        var val_exp_lab_1                 = $('#val_exp_lab_1',form).val();

        var nombre_empresa_2_pn           = $('#nombre_empresa_2_pn',form).val();
        var cargo_2_pn                    = $('#cargo_2_pn',form).val();
        var tiempo_ingreso_exp_2_pn       = $('#tiempo_ingreso_exp_2_pn',form).val();
        var y_work_2_pn                   = $('#y_work_2_pn',form).val();
        var tip_car_2                     = $('#tip_car_2',form).val();
        var tiempo_salida_2_pn            = $('#tiempo_salida_2_pn',form).val();
        var jefe_inmediato_2_pn           = $('#jefe_inmediato_2_pn',form).val();
        var celular_exp_2_pn              = $('#celular_exp_2_pn',form).val();
        var comp_rl_2_pn                  = $('#comp_rl_2_pn',form).prop('files')[0];
        var val_exp_lab_2                 = $('#val_exp_lab_2',form).val();

        // referencia academic;
        var nombre_instituto_pn           = $('#nombre_instituto_pn',form).val();
        var nivel_academico_pn            = $('#nivel_academico_pn',form).val();
        var titulo_op_pn                  = $('#titulo_op_pn',form).val();
        var y_stu_pn                      = $('#y_stu_pn',form).val();
        var tiempo_fin_1_pn               = $('#tiempo_fin_1_pn',form).val();
        var comp_stu_pn                   = $('#comp_stu_pn',form).prop('files')[0];
        var val_1                         = $('#val_1',form).val();

        var nombre_instituto_2_pn         = $('#nombre_instituto_2_pn',form).val();
        var nivel_academico_2_pn          = $('#nivel_academico_2_pn',form).val();
        var titulo_op_2_pn                = $('#titulo_op_2_pn',form).val();
        var y_stu_2_pn                    = $('#y_stu_2_pn',form).val();
        var tiempo_fin_2_pn               = $('#tiempo_fin_2_pn',form).val();
        var comp_stu_2_pn                 = $('#comp_stu_2_pn',form).prop('files')[0];
        var val_2                         = $('#val_2',form).val();

        // capacitaciones;
        var lug_capaci_pn                 = $('#lug_capaci_pn',form).val();
        var lug_capacita_pn               = $('#lug_capacita_pn',form).val();
        var fech_capacita_pn              = $('#fech_capacita_pn',form).val();
        var doc_capacita_pn               = $('#doc_capacita_pn',form).prop('files')[0];
        var val_cap_1_pn                  = $('#val_cap_1_pn',form).val();

        var lug_capaci_2_pn               = $('#lug_capaci_2_pn',form).val();
        var lug_capacita_2_pn             = $('#lug_capacita_2_pn',form).val();
        var fech_capacita_2_pn            = $('#fech_capacita_2_pn',form).val();
        var doc_capacita_2_pn             = $('#doc_capacita_2_pn',form).prop('files')[0];
        var val_cap_2_pn                  = $('#val_cap_2_pn',form).val();

        // cualificacion
        var lug_cuali_pn                  = $('#lug_cuali_pn',form).val();
        var lug_cualifica_pn              = $('#lug_cualifica_pn',form).val();
        var fech_cualifi_pn               = $('#fech_cualifi_pn',form).val();
        var doc_cualifi_pn                = $('#doc_cualifi_pn',form).prop('files')[0];
        var val_cua_1                     = $('#val_cua_1',form).val();

        var lug_cuali_2_pn                = $('#lug_cuali_2_pn',form).val();
        var lug_cualifica_2_pn            = $('#lug_cualifica_2_pn',form).val();
        var fech_cualifi_2_pn             = $('#fech_cualifi_2_pn',form).val();
        var doc_cualifi_2_pn              = $('#doc_cualifi_2_pn',form).prop('files')[0];
        var val_cua_2                     = $('#val_cua_2',form).val();

        // otros: cursos, seminarios y diplomados
        var nom_inst_otro_pn              = $('#nom_inst_otro_pn',form).val();
        var tit_op_otro_pn                = $('#tit_op_otro_pn',form).val();
        var tie_fin_otro_1_pn             = $('#tie_fin_otro_1_pn',form).val();
        var comp_otro_pn                  = $('#comp_otro_pn',form).prop('files')[0];
        var val_otro_1_pn                 = $('#val_otro_1_pn',form).val();

        var nom_inst_otro_2_pn            = $('#nom_inst_otro_2_pn',form).val();
        var tit_op_otro_2_pn              = $('#tit_op_otro_2_pn',form).val();
        var tie_fin_otro_2_pn             = $('#tie_fin_otro_2_pn',form).val();
        var comp_otro_2_pn                = $('#comp_otro_2_pn',form).prop('files')[0];
        var val_otro_2_pn                 = $('#val_otro_2_pn',form).val();

        // referencia per
        var nomb_ref_pn                   = $('#nomb_ref_pn',form).val();
        var ape_ref_pn                    = $('#ape_ref_pn',form).val();
        var car_ref_pn                    = $('#car_ref_pn',form).val();
        var cel_ref_pn                    = $('#cel_ref_pn',form).val();
        var val_ref_per_1                 = $('#val_ref_per_1',form).val();

        var nomb_ref_2_pn                 = $('#nomb_ref_2_pn',form).val();
        var ape_ref_2_pn                  = $('#ape_ref_2_pn_pn',form).val();
        var car_ref_2_pn                  = $('#carcar_ref_2_pn_ref_2',form).val();
        var cel_ref_2_pn                  = $('#cel_ref_2_pn',form).val();
        var val_ref_per_2                 = $('#val_ref_per_2',form).val();

        frmDATA.append('archivo_pn',archivo_pn);

        frmDATA.append('primer_nombre_pn',primer_nombre_pn);
        frmDATA.append('segundo_nombre_pn',segundo_nombre_pn);
        frmDATA.append('primer_apellido_pn',primer_apellido_pn);
        frmDATA.append('segundo_apellido_pn',segundo_apellido_pn);
        frmDATA.append('tipo_de_documento_pn',tipo_de_documento_pn);
        frmDATA.append('cedula_de_ciudadania_pn',cedula_de_ciudadania_pn);

        // contact;
        frmDATA.append('direccion_pn',direccion_pn);
        frmDATA.append('departamento_pn',departamento_pn);
        frmDATA.append('municipio_pn',municipio_pn);
        frmDATA.append('celular_cont_pn',celular_cont_pn);
        frmDATA.append('correo_pn',correo_pn);
        frmDATA.append('contacto_area_pn',contacto_area_pn);

        // referencia labora;
        frmDATA.append('nombre_empresa_pn',nombre_empresa_pn);
        frmDATA.append('cargo_pn',cargo_pn);
        frmDATA.append('tiempo_ingreso_exp_pn',tiempo_ingreso_exp_pn);
        frmDATA.append('y_work_pn',y_work_pn);
        frmDATA.append('tip_car_1',tip_car_1);
        frmDATA.append('tiempo_salida_1_pn',tiempo_salida_1_pn);
        frmDATA.append('jefe_inmediato_pn',jefe_inmediato_pn);
        frmDATA.append('celular_exp_pn',celular_exp_pn);
        frmDATA.append('comp_rl_pn',comp_rl_pn);
        frmDATA.append('val_exp_lab_1',val_exp_lab_1);

        frmDATA.append('nombre_empresa_2_pn',nombre_empresa_2_pn);
        frmDATA.append('cargo_2_pn',cargo_2_pn);
        frmDATA.append('tiempo_ingreso_exp_2_pn',tiempo_ingreso_exp_2_pn);
        frmDATA.append('y_work_2_pn',y_work_2_pn);
        frmDATA.append('tip_car_2',tip_car_2);
        frmDATA.append('tiempo_salida_2_pn',tiempo_salida_2_pn);
        frmDATA.append('jefe_inmediato_2_pn',jefe_inmediato_2_pn);
        frmDATA.append('celular_exp_2_pn',celular_exp_2_pn);
        frmDATA.append('comp_rl_2_pn',comp_rl_2_pn);
        frmDATA.append('val_exp_lab_2',val_exp_lab_2);

        // referencia academic;
        frmDATA.append('nombre_instituto_pn',nombre_instituto_pn);
        frmDATA.append('nivel_academico_pn',nivel_academico_pn);
        frmDATA.append('y_stu_pn',y_stu_pn);
        frmDATA.append('titulo_op_pn',titulo_op_pn);
        frmDATA.append('tiempo_fin_1_pn',tiempo_fin_1_pn);
        frmDATA.append('comp_stu_pn',comp_stu_pn);
        frmDATA.append('val_1',val_1);

        frmDATA.append('nombre_instituto_2_pn',nombre_instituto_2_pn);
        frmDATA.append('nivel_academico_2_pn',nivel_academico_2_pn);
        frmDATA.append('y_stu_2_pn',y_stu_2_pn);
        frmDATA.append('titulo_op_2_pn',titulo_op_2_pn);
        frmDATA.append('tiempo_fin_2_pn',tiempo_fin_2_pn);
        frmDATA.append('comp_stu_2_pn',comp_stu_2_pn);
        frmDATA.append('val_2',val_2);

        // capacitaciones;

        frmDATA.append('lug_capaci_pn',lug_capaci_pn);
        frmDATA.append('lug_capacita_pn',lug_capacita_pn);
        frmDATA.append('fech_capacita_pn',fech_capacita_pn);
        frmDATA.append('doc_capacita_pn',doc_capacita_pn);
        frmDATA.append('val_cap_1_pn',val_cap_1_pn);

        frmDATA.append('lug_capaci_2_pn',lug_capaci_2_pn);
        frmDATA.append('lug_capacita_2_pn',lug_capacita_2_pn);
        frmDATA.append('fech_capacita_2_pn',fech_capacita_2_pn);
        frmDATA.append('doc_capacita_2_pn',doc_capacita_2_pn);
        frmDATA.append('val_cap_2_pn',val_cap_2_pn);
        
        // otros: cursos, seminarios y diplomados
        frmDATA.append('nom_inst_otro_pn',nom_inst_otro_pn);
        frmDATA.append('tit_op_otro_pn',tit_op_otro_pn);
        frmDATA.append('tie_fin_otro_1_pn',tie_fin_otro_1_pn);
        frmDATA.append('comp_otro_pn',comp_otro_pn);
        frmDATA.append('val_otro_1_pn',val_otro_1_pn);

        frmDATA.append('nom_inst_otro_2_pn',nom_inst_otro_2_pn);
        frmDATA.append('tit_op_otro_2_pn',tit_op_otro_2_pn);
        frmDATA.append('tie_fin_otro_2_pn',tie_fin_otro_2_pn);
        frmDATA.append('comp_otro_2_pn',comp_otro_2_pn);
        frmDATA.append('val_otro_2_pn',val_otro_2_pn);

        // cualificacio;
        frmDATA.append('lug_cuali_pn',lug_cuali_pn);
        frmDATA.append('lug_cualifica_pn',lug_cualifica_pn);
        frmDATA.append('fech_cualifi_pn',fech_cualifi_pn);
        frmDATA.append('doc_cualifi_pn',doc_cualifi_pn);
        frmDATA.append('val_cua_1',val_cua_1);

        frmDATA.append('lug_cuali_2_pn',lug_cuali_2_pn);
        frmDATA.append('lug_cualifica_2_pn',lug_cualifica_2_pn);
        frmDATA.append('fech_cualifi_2_pn',fech_cualifi_2_pn);
        frmDATA.append('doc_cualifi_2_pn',doc_cualifi_2_pn);
        frmDATA.append('val_cua_2',val_cua_2);

        // referenci;
        frmDATA.append('nomb_ref_pn',nomb_ref_pn);
        frmDATA.append('ape_ref_pn',ape_ref_pn);
        frmDATA.append('car_ref_pn',car_ref_pn);
        frmDATA.append('cel_ref_pn',cel_ref_pn);
        frmDATA.append('val_ref_per_1',val_ref_per_1);

        frmDATA.append('nomb_ref_2_pn',nomb_ref_2_pn);
        frmDATA.append('ape_ref_2_pn',ape_ref_2_pn);
        frmDATA.append('car_ref_2_pn',car_ref_2_pn);
        frmDATA.append('cel_ref_2_pn',cel_ref_2_pn);
        frmDATA.append('val_ref_per_2',val_ref_per_2);

        var data_form = {
            // informacion general
            archivo_pn :                   $('#archivo_pn',form).val(),

            primer_nombre_pn :             $('#primer_nombre_pn',form).val(),
            segundo_nombre_pn :            $('#segundo_nombre_pn',form).val(),
            primer_apellido_pn :           $('#primer_apellido_pn',form).val(),
            segundo_apellido_pn :          $('#segundo_apellido_pn',form).val(),
            tipo_de_documento_pn :         $('#tipo_de_documento_pn',form).val(),
            cedula_de_ciudadania_pn :      $('#cedula_de_ciudadania_pn',form).val(),

            // contact;
            direccion_pn :                 $('#direccion_pn',form).val(),
            departamento_pn :              $('#departamento_pn',form).val(),
            municipio_pn :                 $('#municipio_pn',form).val(),
            celular_cont_pn :              $('#celular_cont_pn',form).val(),
            correo_pn :                    $('#correo_pn',form).val(),
            contacto_area_pn :             $('#contacto_area_pn',form).val(),

            // referencia labora;
            nombre_empresa_pn :            $('#nombre_empresa_pn',form).val(),
            cargo_pn :                     $('#cargo_pn',form).val(),
            tiempo_ingreso_exp_pn :        $('#tiempo_ingreso_exp_pn',form).val(),
            y_work_pn :                    $('#y_work_pn',form).val(),
            tip_car_1 :                    $('#tip_car_1',form).val(),
            tiempo_salida_1_pn :           $('#tiempo_salida_1_pn',form).val(),
            jefe_inmediato_pn :            $('#jefe_inmediato_pn',form).val(),
            celular_exp_pn :               $('#celular_exp_pn',form).val(),
            comp_rl_pn :                   $('#comp_rl_pn',form).val(),
            val_exp_lab_1 :                $('#val_exp_lab_1',form).val(),

            nombre_empresa_2_pn :          $('#nombre_empresa_2_pn',form).val(),
            cargo_2_pn :                   $('#cargo_2_pn',form).val(),
            tiempo_ingreso_exp_2_pn :      $('#tiempo_ingreso_exp_2_pn',form).val(),
            y_work_2_pn :                  $('#y_work_2_pn',form).val(),
            tip_car_2 :                    $('#tip_car_2',form).val(),
            tiempo_salida_2_pn :           $('#tiempo_salida_2_pn',form).val(),
            jefe_inmediato_2_pn :          $('#jefe_inmediato_2_pn',form).val(),
            celular_exp_2_pn :             $('#celular_exp_2_pn',form).val(),
            comp_rl_2_pn :                 $('#comp_rl_2_pn',form).val(),
            val_exp_lab_2 :                $('#val_exp_lab_2',form).val(),

            // referencia academic;
            nombre_instituto_pn :          $('#nombre_instituto_pn',form).val(),
            nivel_academico_pn :           $('#nivel_academico_pn',form).val(),
            titulo_op_pn :                 $('#titulo_op_pn',form).val(),
            y_stu_pn :                     $('#y_stu_pn',form).val(),
            tiempo_fin_1_pn :              $('#tiempo_fin_1_pn',form).val(),
            comp_stu_pn :                  $('#comp_stu_pn',form).val(),
            val_1 :                        $('#val_1',form).val(),

            nombre_instituto_2_pn :        $('#nombre_instituto_2_pn',form).val(),
            nivel_academico_2_pn :         $('#nivel_academico_2_pn',form).val(),
            titulo_op_2_pn :               $('#titulo_op_2_pn',form).val(),
            y_stu_2_pn :                   $('#y_stu_2_pn',form).val(),
            tiempo_fin_2_pn :              $('#tiempo_fin_2_pn',form).val(),
            comp_stu_2_pn :                $('#comp_stu_2_pn',form).val(),
            val_2 :                        $('#val_2',form).val(),

            // capacitaciones;
            lug_capaci_pn :                $('#lug_capaci_pn',form).val(),
            lug_capacita_pn :              $('#lug_capacita_pn',form).val(),
            fech_capacita_pn :             $('#fech_capacita_pn',form).val(),
            doc_capacita_pn :              $('#doc_capacita_pn',form).val(),
            val_cap_1_pn :                 $('#val_cap_1_pn',form).val(),

            lug_capaci_2_pn :              $('#lug_capaci_2_pn',form).val(),
            lug_capacita_2_pn :            $('#lug_capacita_2_pn',form).val(),
            fech_capacita_2_pn :           $('#fech_capacita_2_pn',form).val(),
            doc_capacita_2_pn :            $('#doc_capacita_2_pn',form).val(),
            val_cap_2_pn :                 $('#val_cap_2_pn',form).val(),

            // cualificacion
            lug_cuali_pn :                 $('#lug_cuali_pn',form).val(),
            lug_cualifica_pn :             $('#lug_cualifica_pn',form).val(),
            fech_cualifi_pn :              $('#fech_cualifi_pn',form).val(),
            doc_cualifi_pn :               $('#doc_cualifi_pn',form).val(),
            val_cua_1 :                    $('#val_cua_1',form).val(),

            lug_cuali_2_pn :               $('#lug_cuali_2_pn',form).val(),
            lug_cualifica_2_pn :           $('#lug_cualifica_2_pn',form).val(),
            fech_cualifi_2_pn :            $('#fech_cualifi_2_pn',form).val(),
            doc_cualifi_2_pn :             $('#doc_cualifi_2_pn',form).val(),
            val_cua_2 :                    $('#val_cua_2',form).val(),

            // otros: cursos, seminarios y diplomados
            nom_inst_otro_pn :             $('#nom_inst_otro_pn',form).val(),
            tit_op_otro_pn :               $('#tit_op_otro_pn',form).val(),
            tie_fin_otro_1_pn :            $('#tie_fin_otro_1_pn',form).val(),
            comp_otro_pn :                 $('#comp_otro_pn',form).val(),
            val_otro_1_pn :                $('#val_otro_1_pn',form).val(),

            nom_inst_otro_2_pn :           $('#nom_inst_otro_2_pn',form).val(),
            tit_op_otro_2_pn :             $('#tit_op_otro_2_pn',form).val(),
            tie_fin_otro_2_pn :            $('#tie_fin_otro_2_pn',form).val(),
            comp_otro_2_pn :               $('#comp_otro_2_pn',form).val(),
            val_otro_2_pn :                $('#val_otro_2_pn',form).val(),

            // referencia per
            nomb_ref_pn :                  $('#nomb_ref_pn',form).val(),
            ape_ref_pn :                   $('#ape_ref_pn',form).val(),
            car_ref_pn :                   $('#car_ref_pn',form).val(),
            cel_ref_pn :                   $('#cel_ref_pn',form).val(),
            val_ref_per_1 :                $('#val_ref_per_1',form).val(),

            nomb_ref_2_pn :                $('#nomb_ref_2_pn',form).val(),
            ape_ref_2_pn :                 $('#ape_ref_2_pn',form).val(),
            car_ref_2_pn :                 $('#car_ref_2_pn',form).val(),
            cel_ref_2_pn :                 $('#cel_ref_2_pn',form).val(),
            val_ref_per_2 :                $('#val_ref_per_2',form).val()
        };
        
        edad = calcularEdad(data_form.fecha_nacimiento);
        var extPermitidas = /(.png|.jpg|.jpeg|.pdf|.PNG|.JPG|.JPEG|.PDF)$/i;

        // VALIDACION DE DATOS FOMULARIO
        // Validacion de extenciones de documentos
        if ( data_form.archivo_pn !== undefined && archivo_uno == true) {
            var filename = $('#archivo_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.archivo_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo para imagen:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.doc_cualifi_pn !== undefined && archivo_doc1 == true) {
            var filename = $('#doc_cualifi_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.doc_cualifi_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo para primera cualifición:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.doc_cualifi_2_pn !== undefined && archivo_doc2 == true) {
            var filename = $('#doc_cualifi_2_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.doc_cualifi_2_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo para segunda cualifición:  "+filename+"  NO PERMITIDO <br>";
            }
        }
		
		if ( data_form.doc_capacita_pn !== undefined && archivo_cap1 == true) {
            var filename = $('#doc_capacita_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.doc_capacita_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo para primera capacitación:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.doc_capacita_2_pn !== undefined && archivo_cap2 == true) {
            var filename = $('#doc_capacita_2_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.doc_capacita_2_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo para segunda capacitación:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.comp_stu_pn !== undefined && archivo_estu1 == true) {
            var filename = $('#comp_stu_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.comp_stu_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo para primer estudio:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.comp_stu_2_pn !== undefined && archivo_estu2 == true) {
            var filename = $('#comp_stu_2_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.comp_stu_2_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo para segundo estudio:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.comp_rl_pn !== undefined && archivo_reflab1 == true) {
            var filename = $('#comp_rl_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.comp_rl_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo de primera comprobación laboral:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.comp_rl_2_pn !== undefined && archivo_reflab2 == true) {
            var filename = $('#comp_rl_2_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.comp_rl_2_pn;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo de segunda comprobación laboral:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.comp_otro_pn !== undefined && archivo_otro1 == true) {
            var filename = $('#comp_otro_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.comp_otro_pn;
            console.log("Seccion 1: " + valor);
            if(!extPermitidas.exec(valor)){
                msg += "Archivo de primera seccion de otros cursos:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.comp_otro_2_pn !== undefined && archivo_otro2 == true) {
            var filename = $('#comp_otro_2_pn').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.comp_otro_2_pn;
            console.log("Seccion 2: " + valor);
            if(!extPermitidas.exec(valor)){
                msg += "Archivo de segunda seccion de otros cursos:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        data_form.primer_nombre_pn.length == 0 ? msg += "Ingrese al menos un nombre <br>" : "";
        data_form.primer_apellido_pn.length == 0 ? msg += "Ingrese al menos un apellido <br>" : "";
        (validacion_num(data_form.primer_nombre_pn + data_form.segundo_nombre_pn + data_form.primer_apellido_pn + data_form.segundo_apellido_pn)) ? msg += "El nombre no puede tener numero <br>" : "";
        data_form.tipo_de_documento_pn == "--" ? msg += "Debe seleccionar un tipo de documento <br>" : "";
        (data_form.cedula_de_ciudadania_pn.length > 13 || data_form.cedula_de_ciudadania_pn.length == 0) ? msg += "Ingrese un numero de documento valido <br>" : "";

        // Validacion informacion de contacto
        data_form.direccion_pn.length == 0 ? msg += "Debe ingresar una direccion de recidencia <br>" : "";
        (data_form.celular_cont_pn.length !== 10 || data_form.celular_cont_pn < 3000000000 || data_form.celular_cont_pn > 3999999999 ) ? msg += "Debe ingresar un numero celular valido que comience por 3 y con 10 digitos <br>" : "";
        data_form.correo_pn == null ? msg += "Debe ingresar un correo electronico <br>" : "";

        // VALIDACION DE SECCIONES
        let primera_ref_lab = data_form.nombre_empresa_pn + data_form.cargo_pn + data_form.tiempo_ingreso_exp_pn + data_form.y_work_pn + data_form.tip_car_1 + data_form.jefe_inmediato_pn + data_form.celular_exp_pn;
        let segundo_ref_lab = data_form.nombre_empresa_2_pn + data_form.cargo_2_pn + data_form.tiempo_ingreso_exp_2_pn + data_form.y_work_2_pn + data_form.tip_car_2 + data_form.jefe_inmediato_2_pn + data_form.celular_exp_2_pn;

        let primera_for_aca = data_form.nombre_instituto_pn + data_form.nivel_academico_pn + data_form.titulo_op_pn + data_form.y_stu_pn;
        let segundo_for_aca = data_form.nombre_instituto_2_pn + data_form.nivel_academico_2_pn + data_form.titulo_op_2_pn + data_form.y_stu_2_pn;

		let primera_cap = data_form.lug_capaci_pn + data_form.lug_capacita_pn + data_form.fech_capacita_pn ;
        let segundo_cap = data_form.lug_capaci_2_pn + data_form.lug_capacita_2_pn + data_form.fech_capacita_2_pn ;

        let primera_cua = data_form.lug_cuali_pn + data_form.lug_cualifica_pn + data_form.fech_cualifi_pn;
        let segundo_cua = data_form.lug_cuali_2_pn + data_form.lug_cualifica_2_pn + data_form.fech_cualifi_2_pn ;
		
		let primera_otro = data_form.nom_inst_otro_pn + data_form.tit_op_otro_pn + data_form.tie_fin_otro_1_pn;
        let segundo_otro = data_form.nom_inst_otro_2_pn + data_form.tit_op_otro_2_pn + data_form.tie_fin_otro_2_pn;
		
        let primera_ref_per = data_form.nomb_ref_pn + data_form.ape_ref_pn + data_form.car_ref_pn + data_form.cel_ref_pn;
        let segundo_ref_per = data_form.nomb_ref_2_pn + data_form.ape_ref_2_pn + data_form.car_ref_2_pn + data_form.cel_ref_2_pn;

        // Validacion de referencias laborales
        (primera_ref_lab !== "----" && ((data_form.nombre_empresa_pn == "") || (data_form.cargo_pn == "") || (data_form.tiempo_ingreso_exp_pn == "") || (data_form.y_work_pn == "no" && data_form.tiempo_salida_1_pn == "") || (data_form.y_work_pn == '--') || (data_form.tip_car_1 == '--') || (data_form.jefe_inmediato_pn == "") || (data_form.celular_exp_pn == ""))) ? msg += "Los campos en la primera referencia laboral deben estar completos <br>" : "";
        (segundo_ref_lab !== "----" && ((data_form.nombre_empresa_2_pn == "") || (data_form.cargo_2_pn == "") || (data_form.tiempo_ingreso_exp_2_pn == "") || (data_form.y_work_2_pn == 'no' && data_form.tiempo_salida_2_pn == "") || (data_form.y_work_2_pn == '--') || (data_form.tip_car_2 == '--') || (data_form.jefe_inmediato_2_pn == "") || (data_form.celular_exp_2_pn == ""))) ? msg += "Los campos de la segunda referencia laboral deben estar completos <br>" : ""; 

        // Validacion de formacion academica
        (primera_for_aca !== "--" && ((data_form.nombre_instituto_pn == "") || (data_form.nivel_academico_pn == "") || (data_form.titulo_op_pn == "") || (data_form.y_stu_pn == 'no' && data_form.tiempo_fin_1_pn == '') || (data_form.y_stu_pn == '--'))) ? msg += "Los campos en la primera educacion academica deben estar completos <br>" : "";
        (segundo_for_aca !== "--" && ((data_form.nombre_instituto_2_pn == "") || (data_form.nivel_academico_2_pn == "") || (data_form.titulo_op_2_pn == "") || (data_form.y_stu_2_pn == 'no' && data_form.tiempo_fin_2_pn == '') || (data_form.y_stu_pn == '--'))) ? msg += "Los campos en la segundo educacion academica deben estar completos <br>" : "";

        // Validacion de capacitacion
        (primera_cap !== "" && ((data_form.lug_capaci_pn == "") || (data_form.lug_capacita_pn == "") || (data_form.fech_capacita_pn == ""))) ?  msg += "Los campos en la primera capacitación deben estar completos <br>" : "";
        (segundo_cap !== "" && ((data_form.lug_capaci_2_pn == "") || (data_form.lug_capacita_2_pn == "") || (data_form.fech_capacita_2_pn == ""))) ? msg += "Los campos en la segundo capacitación deben completos <br>" : "";

        // Validacion de cualificaciones
        (primera_cua !== "" && ((data_form.lug_cuali_pn == "") || (data_form.lug_cualifica_pn == "") || (data_form.fech_cualifi_pn == ""))) ? msg += "Los campos en la primera cualificacion deben estar completos <br>" : "";
        (segundo_cua !== "" && ((data_form.lug_cuali_2_pn == "") || (data_form.lug_cualifica_2_pn == "") || (data_form.fech_cualifi_2_pn == ""))) ? msg += "Los campos en la segundo cualificacion deben completos <br>" : "";
		
		// Validacion de otro
        (primera_otro !== "" && ((data_form.nom_inst_otro_pn == "") || (data_form.tit_op_otro_pn == "") || (data_form.tie_fin_otro_1_pn == ""))) ? msg += "Los campos en la primera seccion cursos, seminarios y diplomados deben estar completos <br>" : "";
        (segundo_otro !== "" && ((data_form.nom_inst_otro_2_pn == "") || (data_form.tit_op_otro_2_pn == "") || (data_form.tie_fin_otro_2_pn == ""))) ? msg += "Los campos en la segundo seccion cursos, seminarios y diplomados deben completos <br>" : "";

        // Validacion de referencias personales
        (primera_ref_per !== "" && ((data_form.nomb_ref_pn == "") || (data_form.ape_ref_pn == "") || (data_form.cel_ref_pn == "") || (data_form.car_ref_pn == ""))) ? msg += "Los campos en la primera referencia personal deben estar completos <br>" : "";
        (segundo_ref_per !== "" && ((data_form.nomb_ref_2_pn == "") || (data_form.ape_ref_2_pn == "") || (data_form.cel_ref_2_pn == "") || (data_form.car_ref_2_pn == ""))) ? msg += "Los campos en la segundo educacion academica deben completos <br>" : "";


        if (msg !== "") {
            $('#contMsgPN').show();
            $('#acVenEmVacMPN').hide();
            $('#acVenEmFallos').show();
            $('#acVenEmFallos').click(function (e) {
                e.preventDefault();
                $('#contMsgPN').hide();
            });
            $('#contMsgVINMPN').html(msg);
        }

        if (msg == "") {
            if (archivo_uno == true) {
                const mod_foto =  "../../modificacion_datos/natural/mod_foto.php";
                $.ajax({
                    type: "POST",
                    url: mod_foto,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                        
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmFallos').hide();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                    }
                });   
            }   
            
            if (inf_gen == true) {
                const mod_inf_gen =  "../../modificacion_datos/natural/mod_inf_gen.php";
                $.ajax({
                    type: "POST",
                    url: mod_inf_gen,
                    data: {
                        pri_nom :           data_form.primer_nombre_pn,
                        seg_nom :           data_form.segundo_nombre_pn,
                        pri_ape :           data_form.primer_apellido_pn,
                        seg_ape :           data_form.segundo_apellido_pn,
                        tip_doc :           data_form.tipo_de_documento_pn,
                        direcci :           data_form.direccion_pn,
                        departamento_pn :   data_form.departamento_pn,
                        municipio_pn :      data_form.municipio_pn,
                        celular :           data_form.celular_cont_pn,
                        correo  :           data_form.correo_pn,
                        descrip :           data_form.contacto_area_pn
                    },
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }   

            // *************************************************************************** //
            // ******************* PRIMERA REFERENCIA LABORAL **************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (primera_ref_lab !== "----" && data_form.val_exp_lab_1 !== "0" && ref_lab_uno == true) {
                const mod_ref_1 =  "../../modificacion_datos/natural/mod_exp_lab_1.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (primera_ref_lab !== "----" && data_form.val_exp_lab_1 == "0") {
                const ins_ref_1 =  "../../actualizacion_datos/natural/ins_exp_lab_1.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ******************* SEGUNDA REFERENCIA LABORAL **************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 2
            if (segundo_ref_lab !== "----" && data_form.val_exp_lab_2 !== "0" && ref_lab_dos == true) {
                const mod_ref_2 =  "../../modificacion_datos/natural/mod_exp_lab_2.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (segundo_ref_lab !== "----" && data_form.val_exp_lab_2 == "0") {
                const ins_ref_2 =  "../../actualizacion_datos/natural/ins_exp_lab_2.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ******************* PRIMERA FORMACION ACADEMICA **************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (primera_for_aca !== "--" && data_form.val_1 !== "0" && for_aca_uno == true) {
                const mod_for_aca_1 =  "../../modificacion_datos/natural/mod_for_aca_1.php";
                $.ajax({
                    type: "POST",
                    url: mod_for_aca_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (primera_for_aca !== "--" && data_form.val_1 == "0") {
                console.log("Entre a la insercion de formacion academica 1");
                console.log(primera_for_aca);
                
                const ins_for_aca_1 =  "../../actualizacion_datos/natural/ins_for_aca_1.php";
                $.ajax({
                    type: "POST",
                    url: ins_for_aca_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ******************* SEGUNDA FORMACION ACADEMICA *************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (segundo_for_aca !== "--" && data_form.val_2 !== "0" && for_aca_dos == true) {
                const act_for_aca_2 =  "../../modificacion_datos/natural/mod_for_aca_2.php";
                $.ajax({
                    type: "POST",
                    url: act_for_aca_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (segundo_for_aca !== "--" && data_form.val_2 == "0") {
                const mod_for_aca_2 =  "../../actualizacion_datos/natural/ins_for_aca_2.php";
                $.ajax({
                    type: "POST",
                    url: mod_for_aca_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ************************* PRIMERA CUALIFICACION *************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (primera_cua !== "" && data_form.val_cua_1 !== "0" && cua_uno == true) {
                const mod_cua_1 =  "../../modificacion_datos/natural/mod_cua_1.php";
                console.log("Si estoy entrando");
                $.ajax({
                    type: "POST",
                    url: mod_cua_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });
            }

            // Insercion de datos referencia laboral 1
            if (primera_cua !== "" && data_form.val_cua_1 == "0") {
                const act_cua_1 =  "../../actualizacion_datos/natural/ins_cua_1.php";
                $.ajax({
                    type: "POST",
                    url: act_cua_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });
            }

            // *************************************************************************** //
            // ************************* SEGUNDA CUALIFICACION *************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (segundo_cua !== "" && data_form.val_cua_2 !== "0" && cua_dos == true) {
                const mod_cua_2 =  "../../modificacion_datos/natural/mod_cua_2.php";
                $.ajax({
                    type: "POST",
                    url: mod_cua_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (segundo_cua !== "" && data_form.val_cua_2 == "0") {
                const ins_cua_1 =  "../../actualizacion_datos/natural/ins_cua_2.php";
                $.ajax({
                    type: "POST",
                    url: ins_cua_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ********************** PRIMERA REFERENCIA PERSONAL ************************ //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (primera_ref_per !== "" && data_form.val_ref_per_1 !== "0" && ref_per_uno == true) {
                console.log("Ingrese a la modificacion de datos de referencia personal 1");
                
                const mod_ref_per_1 =  "../../modificacion_datos/natural/mod_ref_per_1.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_per_1,
                    data: {
                        nombre :        data_form.nomb_ref_pn,
                        apellido :      data_form.ape_ref_pn,
                        cargo:          data_form.car_ref_pn,
                        telefono:       data_form.cel_ref_pn,
                        tipo:           data_form.val_ref_per_1
                    },
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (primera_ref_per !== "" && data_form.val_ref_per_1 == "0") {
                console.log("ingrese a la insersion de datos de referencia personal 1");
                const ins_ref_per_1 =  "../../actualizacion_datos/natural/ins_ref_per_1.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_per_1,
                    data: {
                        nombre :        data_form.nomb_ref_pn,
                        apellido :      data_form.ape_ref_pn,
                        cargo:          data_form.car_ref_pn,
                        telefono:       data_form.cel_ref_pn,
                        tipo:           data_form.val_ref_per_1
                    },
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ********************** SEGUNDA REFERENCIA PERSONAL ************************ //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (segundo_ref_per !== "" && data_form.val_ref_per_2 !== "0" && ref_per_dos == true) {
                const mod_ref_per_2 =  "../../modificacion_datos/natural/mod_ref_per_2.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_per_2,
                    data: {
                        nombre :        data_form.nomb_ref_2_pn,
                        apellido :      data_form.ape_ref_2_pn,
                        cargo:          data_form.car_ref_2_pn,
                        telefono:       data_form.cel_ref_2_pn,
                        tipo:           data_form.val_ref_per_2
                    },
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    console.log("Estoy obteniendo respuesta de la segunda referencia personal");
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });
            }

            // Insercion de datos referencia laboral 1
            if (segundo_ref_per !== "" && data_form.val_ref_per_2 == "0") {
                const ins_ref_per_2 =  "../../actualizacion_datos/natural/ins_ref_per_2.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_per_2,
                    data: {
                        nombre :        data_form.nomb_ref_2_pn,
                        apellido :      data_form.ape_ref_2_pn,
                        cargo:          data_form.car_ref_2_pn,
                        telefono:       data_form.cel_ref_2_pn,
                        tipo:           data_form.val_ref_per_2
                    },
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }
			
			
			// *************************************************************************** //
            // ************************* PRIMERA CAPACITACIÓN **************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (primera_cap !== "" && data_form.val_cap_1_pn !== "0" && cap_uno == true) {
                const mod_ref_per_1 =  "../../modificacion_datos/natural/mod_cap_1.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_per_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (primera_cap !== "" && data_form.val_cap_1_pn == "0") {
                const ins_ref_per_1 =  "../../actualizacion_datos/natural/ins_cap_1.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_per_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ************************** SEGUNDA CAPACITACIÓN *************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (segundo_cap !== "" && data_form.val_cap_2_pn !== "0" && cap_dos == true) {
                const mod_ref_per_2 =  "../../modificacion_datos/natural/mod_cap_2.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_per_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    console.log("Estoy obteniendo respuesta de la segunda referencia personal");
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });
            }

            // Insercion de datos referencia laboral 1
            if (segundo_cap !== "" && data_form.val_cap_2_pn == "0") {
                const ins_ref_per_2 =  "../../actualizacion_datos/natural/ins_cap_2.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_per_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }
			
			// *************************************************************************** //
            // ***************************** PRIMERA OTROS ******************************* //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (primera_otro !== "" && data_form.val_otro_1_pn !== "0" && otr_uno == true) {
                const mod_ref_per_1 =  "../../modificacion_datos/natural/mod_otr_1.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_per_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // Insercion de datos referencia laboral 1
            if (primera_otro !== "" && data_form.val_otro_1_pn == "0") {
                const ins_ref_per_1 =  "../../actualizacion_datos/natural/ins_otr_1.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_per_1,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }

            // *************************************************************************** //
            // ****************************** SEGUNDA OTROS ****************************** //
            // *************************************************************************** //
            // Modificacion de datos referencia laboral 1
            if (segundo_otro !== "" && data_form.val_otro_2_pn !== "0" && otr_dos == true) {
                const mod_ref_per_2 =  "../../modificacion_datos/natural/mod_otr_2.php";
                $.ajax({
                    type: "POST",
                    url: mod_ref_per_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    console.log("Estoy obteniendo respuesta de la segunda referencia personal");
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });
            }

            // Insercion de datos referencia laboral 1
            if (segundo_otro !== "" && data_form.val_otro_2_pn == "0") {
                const ins_ref_per_2 =  "../../actualizacion_datos/natural/ins_otr_2.php";
                $.ajax({
                    type: "POST",
                    url: ins_ref_per_2,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contMsgPN').show();
                        $('#acVenEmVacMPN').hide();
                        $('#acVenEmFallos').show();
                        $('#contMsgVINMPN').html(res.error);
                        $('#acVenEmFallos').click(function (e) {
                            e.preventDefault();
                            $('#contMsgPN').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contMsgPN').show();
                        $('#contMsgVINMPN').html(res.mensaje);
                        $('#acVenEmVacMPN').show();
                        $('#acVenEmVacMPN').click(function (e) { 
                            e.preventDefault();
                            location.reload();
                        });
                        $('#acVenEmFallos').hide();
                    }
                });   
            }
			
            $('#cuerpo_2').hide();
            $('#cuerpo_1').show();
        }
    });

    $('#insert_exp_lab_2').click(function (e) { 
        e.preventDefault();
        $('#expe_lab_2').show();
        $('#insert_exp_lab_2').hide();
    });

    $('#insert_est_2').click(function (e) { 
        e.preventDefault();
        $('#ref_est_2').show();
        $('#cont_add_btn_est').hide();
        $('#insert_est_2').hide();
    });

    $('#insert_cap_2').click(function (e) { 
        e.preventDefault();
        $('#ref_capa_2').show();
        $('#cont_add_btn_cap').hide();
        $('#insert_cap_2').hide();
    });

    $('#insert_otro_2').click(function (e) { 
        e.preventDefault();
        $('#otro_2').show();
        $('#cont_add_btn_otro').hide();
        $('#insert_otro_2').hide();
    });

    $('#insert_cua_2').click(function (e) { 
        e.preventDefault();
        $('#ref_cuali_2').show();
        $('#cont_add_btn_cua').hide();
        $('#insert_cua_2').hide();
    });

    $('#insert_per_2').click(function (e) { 
        e.preventDefault();
        $('#ref_per_2').show();
        $('#cont_add_btn_per').hide();
        $('#insert_per_2').hide();
    });

    // ***************************************************************************************************** //
    // ************************** MODIFICACION DATOS USUARIO EMPRESA *************************************** //
    // ***************************************************************************************************** //
    $('#edi_per_emp').click(function (e) { 
        e.preventDefault();
        $('#cuerpo_emp_2').show();
        $('#cuerpo_emp_1').hide();
    });

    $('.gua_per_emp').click(function (e) { 
        e.preventDefault();
        $('#cuerpo_emp_2').hide();
        $('#cuerpo_emp_1').show();
    });

    var inf_gen_emp = false;
    var mod_log_emp = false;
    var mod_fot_emp = false;

    $('#razon_social_emp, #contacto_area_emp_emp, #mision_emp_emp, #vision_emp_emp').on('input', function () {
        inf_gen_emp = true;
    })

    $('#archivo_foto_emp').on('input', function () {
        mod_fot_emp = true;
    })
    
    $('#archivo_logo').on('input', function () {
        mod_log_emp = true;
    })

    $(document).on('submit',"#act_for_emp",function (e) { 
        e.preventDefault();
        let msg = "";
        var frmDATA = new FormData;
        let form = $(this);

        var archivo_logo                    = $('#archivo_logo',form).prop('files')[0];
        var archivo_foto_emp                = $('#archivo_foto_emp',form).prop('files')[0];
        var razon_social_emp                = $('#razon_social_emp',form).val();
        var contacto_area_emp_emp           = $('#contacto_area_emp_emp',form).val();
        var mision_emp_emp                  = $('#mision_emp_emp',form).val();
        var vision_emp_emp                  = $('#vision_emp_emp',form).val();

        frmDATA.append('archivo_logo',archivo_logo);
        frmDATA.append('archivo_foto_emp',archivo_foto_emp);
        frmDATA.append('razon_social_emp',razon_social_emp);
        frmDATA.append('contacto_area_emp_emp',contacto_area_emp_emp);
        frmDATA.append('mision_emp_emp',mision_emp_emp);
        frmDATA.append('vision_emp_emp',vision_emp_emp);
        
        var data_form = {
            archivo_logo :                  $('#archivo_logo',form).val(),
            archivo_foto_emp :              $('#archivo_foto_emp',form).val(),
            razon_social_emp :              $('#razon_social_emp',form).val(),
            contacto_area_emp_emp :         $('#contacto_area_emp_emp',form).val(),
            mision_emp_emp :                $('#mision_emp_emp',form).val(),
            vision_emp_emp :                $('#vision_emp_emp',form).val(),
        };

        var extPermitidas = /(.png|.gif|.jpg|.jpeg|.PNG|.GIF|.JPG|.JPEG)$/i;

        // VALIDACION DE DATOS FOMULARIO
        // Validacion informacion general
        if ( data_form.archivo_logo !== undefined && mod_log_emp == true) {
            var filename = $('#archivo_logo').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.archivo_logo;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        if ( data_form.archivo_foto_emp !== undefined && mod_fot_emp == true) {
            var filename = $('#archivo_foto_emp').val().replace(/C:\\fakepath\\/i, '');
            var valor = data_form.archivo_foto_emp;
            if(!extPermitidas.exec(valor)){
                msg += "Archivo:  "+filename+"  NO PERMITIDO <br>";
            }
        }

        let total_inf = data_form.razon_social_emp + data_form.contacto_area_emp_emp + data_form.mision_emp_emp + data_form.vision_emp_emp;
        total_inf == "" ? msg += "- Hay campos necesarios que estan vacios <br>" : "";
       
        if (msg !== "") {
            $('#contGlobal').show();
            $('#cuerpoInt').html(msg);
            $('#btn_aceptar').hide();
            $('#btn_fallo').click(function (e) { 
                e.preventDefault();
                $('#contGlobal').hide();
            });
        }

        if (msg == "") {
            
            if (total_inf !== "" && inf_gen_emp == true) {
                const mod_if_ge_emp =  "../../modificacion_datos/empresa/mod_inf_gen.php";
                $.ajax({
                    type: "POST",
                    url: mod_if_ge_emp,
                    data: {
                        razon_s :          data_form.razon_social_emp,
                        descrip :           data_form.contacto_area_emp_emp,
                        mision :            data_form.mision_emp_emp,
                        vision :            data_form.vision_emp_emp
                    },
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contGlobal').show();
                        $('#cuerpoInt').html(res.error);
                        $('#btn_aceptar').hide();
                        $('#btn_fallo').click(function (e) { 
                            e.preventDefault();
                            $('#contGlobal').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contGlobal').show();
                        $('#cuerpoInt').html(res.mensaje);
                        $('#btn_fallo').hide();
                        $('#btn_aceptar').click(function (e) { 
                            e.preventDefault();
                            $('#contGlobal').hide();
                            location.reload();
                        });
                    }
                });   
            }

            if (mod_fot_emp == true) {
                const mod_foto =  "../../modificacion_datos/empresa/mod_foto.php";
                $.ajax({
                    type: "POST",
                    url: mod_foto,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contGlobal').show();
                        $('#cuerpoInt').html(res.error);
                        $('#btn_aceptar').hide();
                        $('#btn_fallo').click(function (e) { 
                            e.preventDefault();
                            $('#contGlobal').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contGlobal').show();
                        $('#cuerpoInt').html(res.mensaje);
                        $('#btn_fallo').hide();
                        $('#btn_aceptar').click(function (e) { 
                            e.preventDefault();
                            $('#contGlobal').hide();
                            location.reload();
                        });
                    }
                });
            }

            if (mod_log_emp == true) {
                const mod_logo =  "../../modificacion_datos/empresa/mod_logo.php";
                $.ajax({
                    type: "POST",
                    url: mod_logo,
                    data: frmDATA,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    async: true
                })
                .done(function ajaxDone(res){
                    if (res.error !== undefined) {
                        $('#contGlobal').show();
                        $('#cuerpoInt').html(res.error);
                        $('#btn_aceptar').hide();
                        $('#btn_fallo').click(function (e) { 
                            e.preventDefault();
                            $('#contGlobal').hide();
                        });
                    }

                    if (res.mensaje) {
                        $('#contGlobal').show();
                        $('#cuerpoInt').html(res.mensaje);
                        $('#btn_fallo').hide();
                        $('#btn_aceptar').click(function (e) { 
                            e.preventDefault();
                            $('#contGlobal').hide();
                            location.reload();
                        });
                    }
                });   
            }
        }		
        $('#cuerpo_emp_2').hide();
        $('#cuerpo_emp_1').show();
    });

    // ***************************************************************************************************** //
    // ************************ PROCESO DE CONTACTO MEDIO ELECTRONICO ************************************** //
    // ***************************************************************************************************** //

    $(document).on('submit', '#form_cont', function (e) {
        e.preventDefault();
        let msg = "";
        let form = $(this);
        var data_form = {
            nom_comp :              $('#nom_comp',form).val(),
            correo :                $('#correo',form).val(),
            telefono :              $('#telefono',form).val(),
            descrip :               $('#descrip',form).val()
        };

        data_form.nom_comp.length == 0 ? msg += "- Debe ingresar un nombre de contactor <br>" : "";
        data_form.correo.length == 0 ? msg += "- Debe ingresar un correo electronico de contacto <br>" : "";
        data_form.telefono.length == 0 ? msg += "- Debe ingreasr un numero telefonico de contacto <br>" : "";
        data_form.descrip.length == 0 ? msg += "- Debe ingresar un motivo de comunicacion <br>" : "";

        if (msg !== "") {
            $('#contMsg').show();
            $('#acVenEmConM').hide();
            $('#contMsgConM').html(msg);
            $('#acVenEmConF').click(function (e) { 
                e.preventDefault();
                $('#contMsg').hide();
            });
        }

        if (msg == "") {
            url_cont = "../../controlador/controlador_contacto.php";
            $.ajax({
                type: "POST",
                url: url_cont,
                data: data_form,
                dataType: "json",
                async: true
            })
            .done(function ajaxDone(res){
                
                if (res.error !== undefined) {
                    $('#contMsg').show();
                    $('#acVenEmConM').hide();
                    $('#contMsgConM').html(res.error);
                    $('#acVenEmConF').click(function (e) { 
                        e.preventDefault();
                        $('#contMsg').hide();
                    });
                }

                if (res.mensaje) {
                    $('#contMsg').show();
                    $('#contMsgConM').html(res.mensaje);
                    $('#acVenEmConF').hide();
                    $('#acVenEmConM').click(function (e) { 
                        e.preventDefault();
                        $('#contMsg').hide();
                        location.reload();
                    });
                }
            });
        }
    });

    $("#edad_mayor").prop("disabled", true);

    $('#edad_menor').change(function (e) { 
        e.preventDefault();
        $("#edad_mayor").prop("disabled", false);
    });    

    $("#municipios").prop("disabled", true);

    $('#departamento').change(function (e) { 
        e.preventDefault();
        $("#municipios").prop("disabled", false);
    });

    $('.input_admin').on('input',function (e) { 
        e.preventDefault();
        $(this).css("background-color", "rgb(232, 240, 254)", "border", "1px solid #444");
    });

    $('#filtro_aspirantes').submit(function (e) {
		e.preventDefault();
		let msg = "";
		

		let form = $(this);
		var data_form = {
			cantidad: $('#cantidad', form).val(),
			cargo: $('#cargo', form).val(),
			edad_menor: $('#edad_menor', form).val(),
			edad_mayor: $('#edad_mayor', form).val(),
			departamento: $('#departamento', form).val(),
			municipios: $('#municipios', form).val(),
			posee_lib: $('#posee_lib', form).val(),
			posee_lic: $('#posee_lic', form).val(),
			cate_lic: $('#cate_lic', form).val(),
			sexo: $('#sexo', form).val(),
			ednia: $('#ednia', form).val(),
			tiempo_exp: $('#tiempo_exp', form).val(),
			nivel_aca: $('#nivel_academico', form).val(),
			cualificacion: $('#cualificacion', form).val(),
		};

		// Validaciones previas
		if (data_form.cantidad == "--") msg += "- Ingrese la cantidad de personal que requiere <br>";
		if (validacion_letra(data_form.tiempo_exp)) msg += "- La cantidad de meses de experiencia que solicita debe ser numérico <br>";
		if (data_form.edad_menor !== "--" && data_form.edad_mayor !== "--" && data_form.edad_menor > data_form.edad_mayor) msg += "- El rango de edad es erróneo <br>";
		if (data_form.edad_menor == "--") msg += "- Debe ingresar un rango de edad del personal <br>";
		if (data_form.departamento != "--" && data_form.municipios == "") msg += "- Ingrese un municipio al que pertenece la vacante <br>";
		if (data_form.posee_lic != "--" && data_form.cate_lic == "--") msg += "- Ingrese la categoría mínima que se solicita en la vacante <br>";

        console.log(msg);
		// Mostrar errores si existen
		if (msg != "") {
			$('#contMsg').show();
			$('#acVenEmConM').hide();
			$('#contMsgConM').html(msg);
			$('#acVenEmConF').click(function (e) {
				e.preventDefault();
				$('#contMsg').hide();
			});
			return;
		}

		// Si no hay errores, ejecuta el AJAX
        let empresa = prompt("INGRESE EL NOMBRE DE LA EMPRESA");
        data_form.empresa = empresa?.toUpperCase() || "";
		let url = "../../obtener_datos/obtener_filtro.php";
		$.ajax({
			type: "post",
			url: url,
			data: data_form,
			dataType: "json",
			async: true
		})
		.done(function (res) {
			console.log('respuesta del servidor: ' +  res);

			if (res.error) {
				console.error("Se encontró un error:", res.error);
				return;
			}

			if (res.fallo) {
				$('#contMsg').show();
				$('#acVenEmConM').hide();
				$('#contMsgConM').html(res.fallo);
				$('#acVenEmConF').click(function (e) {
					e.preventDefault();
					$('#contMsg').hide();
				});
				console.log(res.fallo);
				return;
			}

			// Descarga del archivo Excel si el servidor responde correctamente
			if (res.status === "success" && res.excel) {
				const base64Excel = res.excel;

				const byteCharacters = atob(base64Excel);
				const byteNumbers = new Array(byteCharacters.length).fill(0).map((_, i) => byteCharacters.charCodeAt(i));
				const byteArray = new Uint8Array(byteNumbers);

				const blob = new Blob([byteArray], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });

				const link = document.createElement("a");
				link.href = URL.createObjectURL(blob);
				link.download = "Reclutamiento personal: " + empresa + ".xlsx";
				link.click();

				console.log("¡Archivo descargado exitosamente!");
			} else {
				console.error("No se pudo generar el Excel:", res.message);
			}
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			console.error("Error en la solicitud:", textStatus, errorThrown);
			console.log("Respuesta completa:", jqXHR.responseText);
		});
	});

    $('#form_consulta_admin_uid').submit(function (e) { 
        e.preventDefault();

        let msg ="";
        let form = $(this);
        var data_form = {
            numeroDocumento : $('#numeroDocumento',form).val()
        };

        console.log(data_form);

        data_form.numeroDocumento.length == 0 ? msg += "Ingrese el numero de documento" : "";

        if (msg != "") {
            $('#contMsg').show();
            $('#acVenEmConM').hide();
            $('#contMsgConM').html(msg);
            $('#acVenEmConF').click(function (e) { 
                e.preventDefault();
                $('#contMsg').hide();
            });
        }

        if (msg == "") {
            let url = "../../obtener_datos/admin/obtener_filtro_uid.php";
            $.ajax({
                type: "post",
                url: url,
                data: data_form,
                dataType: "json",
                async: true
            }).done(function ajaxDone(res) {

                if (res.error !== undefined) {
                    $('#resp_consulta_nat').html(
                        `
                        <div class="alert alert-danger">
                            ${res.error}
                        </div>
                        `
                    );
                }

                if (res.mensaje !== undefined) {
                    $('#resp_consulta_nat').html(
                        `
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">TIPO DOCUMENTO</th>
                                    <th scope="col">N° DOCUMENTO</th>
                                    <th scope="col">NOMBRE COMPLETO</th>
                                    <th scope="col">CONTRASEÑA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>${res.mensaje[0].tipo_doc}</td>
                                    <td>${res.mensaje[0].numero_doc}</td>
                                    <td>${res.mensaje[0].primer_nombre} ${res.mensaje[0].segundo_nombre} ${res.mensaje[0].primer_apellido} ${res.mensaje[0].segundo_apellido}</td>
                                    <td>${res.mensaje[0].contrasena}</td>
                                </tr>
                            </tbody>
                        </table>
                        `
                    );
                }
            
            });
            
        }

    });

    $('#form_consulta_admin_enit').submit(function (e) { 
        e.preventDefault();

        let msg ="";
        let form = $(this);
        var data_form = {
            numeroDocumento : $('#numeroNit',form).val()
        };

        console.log(data_form);

        data_form.numeroDocumento.length == 0 ? msg += "Ingrese el numero de documento" : "";

        if (msg != "") {
            $('#contMsg').show();
            $('#acVenEmConM').hide();
            $('#contMsgConM').html(msg);
            $('#acVenEmConF').click(function (e) { 
                e.preventDefault();
                $('#contMsg').hide();
            });
        }

        if (msg == "") {
            let url = "../../obtener_datos/admin/obtener_filtro_enit.php";
            $.ajax({
                type: "post",
                url: url,
                data: data_form,
                dataType: "json",
                async: true
            }).done(function ajaxDone(res) {

                if (res.error !== undefined) {
                    $('#resp_consulta_emp').html(
                        `
                        <div class="alert alert-danger">
                            ${res.error}
                        </div>
                        `
                    );
                }

                if (res.mensaje !== undefined) {
                    $('#resp_consulta_emp').html(
                        `
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">N° NIT</th>
                                    <th scope="col">RAZON SOCIAL</th>
                                    <th scope="col">CONTRASEÑA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>${res.mensaje[0].id_empresa}</td>
                                    <td>${res.mensaje[0].razon_social}</td>
                                    <td>${res.mensaje[0].contrasena}</td>
                                </tr>
                            </tbody>
                        </table>
                        `
                    );
                }
            
            });
            
        }

    });

});