<?php

require './PHP_Mailer/PHPMailer.php';
require './PHP_Mailer/SMTP.php';
require './PHP_Mailer/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;

$phpMailer = new PHPMailer();

function enviarMail($mailer, $emailTo, $subject, $message)
{
    try {
        //settings del server
        $mailer->isSMTP();
        $mailer->SMTPDebug = 0;                                           
        $mailer->Host       = "smtp.gmail.com";     
        $mailer->SMTPSecure = 'ssl';                
        $mailer->SMTPAuth   = true;
        $mailer->Username = "a.escribano@sapalomera.cat";
        $mailer->Password = openssl_decrypt("0T/NZfFJwu28NONES36x+g==","AES-128-ECB","password"); //contrasenya encriptada                               
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mailer->Port       = 465;
        
        //Destinatari i remitent
        $mailer->setFrom("a.escribano@sapalomera.cat", "Admin");
        $mailer->addAddress($emailTo);

        //Contingut
        $mailer->isHTML(true);
        $mailer->Subject = $subject;
        $mailer->Body    = $message;

        $mailer->send();

        $resultat = 'Mail enviat amb èxit';
        return [$resultat, 'success'];
    } catch (\Throwable $th) {
        $estat = "El missatge no s'ha pogut enviar. Error: {$th}";
        return [$estat, 'error'];
    }
}

?>