<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $cont       = [];
        $nombre     = $_POST["nom_comp"];
        $correo     = $_POST["correo"];
        $telefono   = $_POST["telefono"];
        $mensaje    = $_POST["descrip"];

        // Crear una instancia de PHPMailer
        require '../PHPMailer/PHPMailer.php';
        require '../PHPMailer/SMTP.php';
        require '../PHPMailer/Exception.php';

        $mail = new PHPMailer(true);

        try {
            // Configurar el servidor SMTP
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'mail.vigiempleo.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'contacto@vigiempleo.com';
            $mail->Password = 'Colombia2023*';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configurar el remitente y el destinatario
            $mail->setFrom('contacto@vigiempleo.com', 'Contacto formulario');
            $mail->addAddress('vigiempleocom@gmail.com' , 'Vigiempleo receptor contacto');

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Mensaje de contacto desde el formulario: ' . $nombre;
            $mail->Body = "Nombre: $nombre<br>Correo: $correo<br>Teléfono: $telefono<br>Motivo: $mensaje";

            // Envía el correo
            $mail->send();
            $cont['mensaje'] = 'Se realiza el envio de correo electronico correctamente';   
        } catch (Exception $e) {
            $cont['error'] =  'Surgio un error de envio' . $e->getMessage();
        }
        echo json_encode($cont);
    }
?>
