<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
////////////////////////Datos Confirguracion del Correo/////////////////
$mail = new PHPMailer(true);
try {
    $mail = new PHPMailer();  // create a new object
    $mail->Host = 'a2plcpnl0253.prod.iad2.secureserver.net';
    $mail->Port = 465; 
    $mail->Username = 'enriquealducin@siswebs.com.mx';  
    $mail->Password = 'Portero1';
    
    //Recipients
    
    
    $mail->setFrom(trim($correo_envia[0]),$correo_envia[1]);
    foreach ($correos as $correo) {
        $mail->addAddress(trim($correo[0]), $correo[1]);
    }
    
    
    /*
    print_r($correo_envia);
      $mail->setFrom('enriquedamasco58@gmail.com','Sisweb CEO');
      
      */
    //$mail->addAddress('enriquealducin@outlook.com', 'Enrique Alducin');     // Add a recipient
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
    // $mail->AltBody = 'Por si no reconoce el html';
    $mail->CharSet = 'UTF-8';
    echo $asunto;
    
    if(!$mail->send()) {
        $error = 'Mail error: '.$mail->ErrorInfo; 
    } else {
        $error = 'Message sent!';
    } 
    echo $error;
    //echo $cuerpo;
    //echo "Mensaje Enviado";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
////////////////////////Datos Confirguracion del Correo/////////////////

?>