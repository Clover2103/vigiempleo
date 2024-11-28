<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipo                 = $_POST["tipo"];

    if ($tipo === "N") {

        // Datos para usuario natural
        $primer_nombre = $_POST["nombre"];
        $primer_apellido = $_POST["apellido"];
        $nom_comp = $primer_nombre . " " . $primer_apellido;
        $correo = $_POST["correo"];
        $token = $_POST["token"];
        
        $subject = 'Verificación de token para el señor(a): ' . $nom_comp;
        $body = "EL SIGUIENTE ES UN TOKEN DE VERIFICACIÓN PARA CORREO ELECTRONICO DE VIGIEMPLEO <br><br>
                    TOKEN: <b> " . $token . "</b>";

    } else if ($tipo === "E"){

        // Datos para empresa
        $razon_social = $_POST["nombre"];
        $correo = $_POST["correo"];
        $token = $_POST["token"];
        
        $subject = 'Verificación de token para la empresa: ' . $razon_social;
        $body = "EL SIGUIENTE ES UN TOKEN DE VERIFICACIÓN PARA LA EMPRESA <br><br>
                    TOKEN: <b>" . $token . "</b>";
    }

    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
    require '../PHPMailer/Exception.php';

    $mail = new PHPMailer(true);

    try {
        // Configurar el servidor SMTP
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'mail.cognoseguridad.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ingenieria@cognoseguridad.com';
        $mail->Password = 'Admin*3822';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el remitente y el destinatario
        $mail->setFrom('ingenieria@cognoseguridad.com', 'Contacto formulario');
        $mail->addAddress($correo, $tipo === 'N' ? 'Vigiempleo receptor contacto' : 'Vigiempleo empresa contacto');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Envía el correo
        $mail->send();
        $cont['mensaje'] = '<input type="hidden" value="'. $token . '" name="" id="token_invi">';
        $cont['correo'] = '<b>' . $correo . '</b>';
    } catch (Exception $e) {
        $cont['error'] = 'Surgio un error de envio: ' . $e->getMessage();
    }

    echo json_encode($cont);
    

}

?>