<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ("vendor/autoload.php");

function SendEmail($subject, $body, $email, $name, $html = false)
{

    //Configuraciones del Servidor con mailtrap.io
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $phpmailer->Port = 465;
    $phpmailer->Username = 'juan.isaza.sep@gmail.com';
    $phpmailer->Password = 'otxa zahn yjfy mlgy';

    //Destinatarios
    $phpmailer->setFrom('juan.isaza.sep@gmail.com', 'JuanIsaza');
    $phpmailer->addAddress($email, $name);

    // Contenido de mi mensaje
    $phpmailer->isHTML($html);
    $phpmailer->Subject = $subject;
    $phpmailer->Body    = $body;
    $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $phpmailer->send();
}
