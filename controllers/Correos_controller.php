<?php

require URLFW . 'phpmailer/PHPMailerAutoload.php';

class Correos_controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    function enviarcorreo($correo, $nombre, $asunto, $cuerpo) {
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'mail.hardmachineaqp.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'crm@hardmachineaqp.com'; // SMTP username
        $mail->Password = 'kassandra@2015'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to
        $mail->setFrom('crm@hardmachineaqp.com', 'CRM HARDMACHINE');
        $mail->addAddress($correo, $nombre); // Add a recipient
        //$mail->AddReplyTo('replyto@email.com', 'Reply to name');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->MsgHTML($cuerpo);
        $mail->CharSet = 'UTF-8';
        if (!$mail->send()) {
            echo 'No se pudo enviar el mensaje.<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
        } else {
            echo 'El mensaje ha sido enviado<br>';
        }
    }

    function EmailBienvenida($correo, $empresa) {
        $nombre = $empresa;
        $asunto = "Bienvenid@ a CRM AMDDIGITAL";
        $cuerpo = "Le damos la bienvenid@  a CRM AMDDIGITAL";
        Correos_controller::enviarcorreo($correo, $nombre, $asunto, $cuerpo);
    }

    function CorreoMisClientes($correo_remitente, $correo_destinatario, $nombre_detinatario, $cuerpo, $correo_usuario, $nombre_usuario, $opcion,$asunto) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'mail.hardmachineaqp.com';
        $mail->SMTPAuth = true; //
        $mail->Username = 'crm@hardmachineaqp.com';
        $mail->Password = 'kassandra@2015';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('crm@hardmachineaqp.com', 'CRM AMDIGITAL SISTEMA');
        if ($opcion == 'C') {
            $mail->addAddress($correo_destinatario, $nombre_detinatario);
        } elseif ($opcion == 'V') {
            $mail->addAddress($correo_usuario, $nombre_usuario);
        }
        $mail->addAddress($correo_remitente, 'CRM AMDIGITAL');
        $mail->AddReplyTo($correo_remitente, 'CRM AMDIGITAL');
        $mail->Subject = 'CRM AMDIGITAL - '.$asunto;
        $mail->MsgHTML($cuerpo);
        $mail->CharSet = 'UTF-8';
        if (!$mail->send()) {
            echo 'No se pudo enviar el mensaje.<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
        } else {
            echo 'El mensaje ha sido enviado<br>';
        }
    }

}
