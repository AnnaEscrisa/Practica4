<?php

//Controla la recuperació de la contrasenya

require 'utils/mailer.controller.php';
require "model/user.model.php";
$userModel = new Usuari();

$pageTitle = 'Recuperació';
$usuari = $_POST["usuari"] ?? null;
$codiPost = $_POST["codiPost"] ?? null;

showMessage($tipus, $missatge, $displayEliminar);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //petició de codi per part de l'usuari
    if ($usuari) {
        $user = $userModel->selectUserByUsername($usuari);

        if ($user) {
            $user = $user[0];
            $token = sha1(uniqid(rand(), true));
            $expiracio = time() + 7200;
            $user_id = $user['id'];

            //esborra els codis passats en enviar un de nou
            $userModel->deleteBy('user_codes', 'user_id', $user_id);
            //insereix el codi nou a la seva taula
            $userModel->inserirCodiUsuari($token, $user_id, $expiracio);

            $mailTo = $user['email'];
            $mailSubject = "Recuperacio de contrasenya";
            $mailBody = "
                <p>Hola " . $user['name'] . ", </p>
                <p>Aquest es el teu codi de recuperacio per la teva contrasenya:  </p>
                <a href=''>Recupera la contrasenya</a>";

            $result = enviarMail($phpMailer, $mailTo, $mailSubject, $mailBody);
            $error = $result[0];
            $class = $result[1];

            buildMessage($error, $class, 'recupera', '');
        } else {
            //usuari no trobat
            $error = $error_rec1;
            $tipus = 'error';
            showMessage($tipus, $error, $displayEliminar);
        }
        
        //inroducció de codi de recuperacio
        //! ELIMINAR una vegada s'hagi fet lo del token
    } else if ($usuari && $codiPost) {

        $user = $userModel->selectUserByUsername($usuari)[0];

        //buscar codi per user id
        if ($userModel->comprovarCodi($codiPost, $user['id'])) {
            //donem permís per canviar la contrasenya durant 2 hores
            setcookie('permisCanviPass', true, time() + 3600);
            header('Location: regeneracio?id=' . $user['id']);
            exit();
        } else {
            $error = $error_rec2;
            showMessage($class, $error, $displayEliminar);
        }

    }
    else {
        $error = $error_g1;
        showMessage($class, $error, $displayEliminar);
    }
}

include 'view/recupera.vista.php';
