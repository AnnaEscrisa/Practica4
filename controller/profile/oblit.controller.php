<?php

//Controla la recuperació de la contrasenya


//enviar mail recuperacio
function enviarMail($user, $mailerController, $link)
{

    $mailTo = $user['email'];
    $mailSubject = "Recuperacio de contrasenya";
    $mailBody = "
        <p>Hola " . $user['name'] . ", </p>
        <p>Aquest es el teu codi de recuperacio per la teva contrasenya:  </p>
        <a href='$link'>Recupera la contrasenya</a>";

    return $mailerController->enviarMail($mailTo, $mailSubject, $mailBody);
}

function recuperacio($userModel, $mailerController, &$missatge, &$tipus)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $usuari = $_POST["usuari"] ?? null;
        $user = $userModel->selectUserByUsername($usuari) ?? null;

        if ($user) {
            $user = $user[0];
            $token = sha1(uniqid(rand(), true));
            $expiracio = time() + 7200;
            $user_id = $user['id'];

            $ruta = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $link = rtrim(substr($ruta, 0, strrpos($ruta, '/')), '/') . "/new_pass?id=$user_id&token=$token";

            //esborra els codis passats en enviar un de nou
            $userModel->deleteBy('user_codes', 'user_id', $user_id);
            //insereix el codi nou a la seva taula
            $userModel->inserirCodiUsuari($token, $user_id, $expiracio);

            $result = enviarMail($user, $mailerController, $link);

            $missatge = $result[0];
            $tipus = $result[1];

        } else {
            //usuari no trobat
            $missatge = error_rec1;
        }
    }
}


