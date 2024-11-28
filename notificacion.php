<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Incluir las dependencias de PHPMailer
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';
require './PHPMailer/Exception.php';

// Incluir el archivo de conexión a la base de datos
include_once ("./conexion-PDO.php");
$objeto = new Cconexion();
$conexion = $objeto -> conexionBD();

// Función para enviar notificaciones por correo electrónico
function enviar_notificacion_correo($correo, $nombre, $telefono, $fechaCertificacion) {
    $mail = new PHPMailer(true);

    try {

        // Configurar el servidor SMTP
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vigiempleocom@gmail.com';
        $mail->Password = 'jsvi dbez bstt bwoj';
        $mail->SMTPSecure =  'tls'; //PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el remitente y el destinatario
        $mail->setFrom('vigiempleocom@gmail.com', 'Contacto formulario');
        $mail->addAddress($correo , 'Vigiempleo receptor contacto');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Notificacion de reanudacion: ' . $nombre;
        $mail->Body = "Hola sr(a) $nombre,<br><br>
                      Reciba un cordial saludo <br><br>
                      Mediante el presente correo deseamos realizarle recordatorio de que su certificación vencerá el dia $fechaCertificacion. <br><br>
                      Recuerde que gracias a que usted es parte de la familia VIGIEMPLEO.COM podra realizar la renovación de estas certificacion 
                      con nuestro grupo aliado y aplicar hasta un 30% de descuento. Por favor, renueve su certificación antes de la fecha de vencimiento
                      para mantenerse al dia con su actividad labora.<br><br>
                      Recuerde que cualquier inquietud puede comunicarse con nosotros por cualquier medio de contacto:<br>
                      Teléfono: +57 305 4009393<br>
                      Correo Electrónico: vigiempleocom@gmail.com<br><br>
                      Agradecemos mucho su atencion prestada y esperamos saber de usted pronto.<br><br>
                      Atentamente,<br>
                      VIGIEMPLEO";
        // Envía el correo
        $mail->send();
        return 'Se ha enviado el correo electrónico correctamente';
    } catch (Exception $e) {
        return 'Ocurrió un error al enviar el correo: ' . $e->getMessage();
    }
}

try {
    // Obtener la fecha actual
    $fecha_actual = new DateTime();

    // Definir el período de notificación (30 días después de la fecha de certificación)
    $periodo_notificacion = new DateInterval('P335D');
    $periodo_limite = new DateInterval('P365D');

    // Consultar la base de datos para obtener la información de los usuarios
    $query = "SELECT
                cu.nom_cualifi,
                cu.numero_doc,
                cu.fec_cualifi,
                cn.telefono,
                cn.correo,
                un.primer_nombre,
                un.segundo_nombre,
                un.primer_apellido,
                un.segundo_apellido
            FROM
                cualificaciones cu
            INNER JOIN
                (SELECT numero_doc, telefono, correo FROM cont_usuario) cn ON cu.numero_doc = cn.numero_doc
            INNER JOIN
                (SELECT numero_doc, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM usuario_natural) un ON cu.numero_doc = un.numero_doc";

    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $fecha_certificacion = new DateTime($usuario['fec_cualifi']);

        // Calcular la fecha límite para la notificación (30 días después de la fecha de certificación)
        $fecha_limite = clone $fecha_certificacion;
        $fecha_limite->add($periodo_notificacion); // Sumar 30 días
        $fecha_limite->add($periodo_limite); // Sumar 30 días

        if ($fecha_actual >= $fecha_limite) {
            // El usuario debe recibir una notificación
            $resultado = enviar_notificacion_correo(
                $usuario['correo'],
                $usuario['primer_nombre'],
                $usuario['telefono'],
                $fecha_limite->format('Y-m-d')
            );
            echo $resultado . '<br>';
        }
    }
} catch (PDOException $e) {
    echo 'Error en la consulta a la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Error general: ' . $e->getMessage();
}
?>
