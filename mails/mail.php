<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
////////////////////////Datos Confirguracion del Correo/////////////////
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->SMTPDebug = 0;                                       // Activar DEbug/errores del correo
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'enriquedamasco58@gmail.com';                     // SMTP username
    $mail->Password   = 'Portero1';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($correo_envia[0], $correo_envia[1]);
    foreach ($correos as $correo) {
        $mail->addAddress($correo[0], $correo[1]);
    }
      
    //$mail->addAddress('verenicegm@gmail.com', 'Enrique Alducin');     // Add a recipient
    //$mail->addAddress('enriquedamasco58@gmail.com');               // Name is optional
    /// para responder $mail->addReplyTo('info@example.com', 'Information');
    // con copia $mail->addCC('cc@example.com');
    //con copia $mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpo;
    //$mail->AltBody = 'Por si no reconoce el html';
    $mail->CharSet = 'UTF-8';
    $mail->send();
    //echo $cuerpo;
    //echo "Mensaje Enviado";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
////////////////////////Datos Confirguracion del Correo/////////////////

?>