<?php

require "model/user.model.php";
$userModel = new Usuari();

$pageTitle = 'Recuperació';
$usuari = $_POST["usuari"] ?? null;
$codiPost = $_POST["codiPost"] ?? null;

showMessage($tipus, $missatge, $displayEliminar);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //petició de codi
    if ($usuari && !$codiPost) {
        $user = $userModel->selectUserByUsername($usuari);

        if ($user) {
            $user = $user[0];
            $codi = substr(md5(uniqid(rand(), true)), 0, 10);
            $expiracio = time() + 7200; //expiracio de dues hores
            $user_id = $user['id'];

            //esborrem els codis passats en enviar un de nou
            $userModel->deleteBy('user_codes', 'user_id', $user_id);
            //inserim el codi nou a la seva taula
            $userModel->inserirCodiUsuari($codi, $user_id, $expiracio);

            $mailTo = $user['email'];
            $mailSubject = "Recuperacio de contrasenya";
            $mailBody = "
                <p>Hola " . $user['name'] . ", </p>
                <p>Aquest es el teu codi de recuperacio per la teva contrasenya:  </p>
                <p><b>$codi</b></p>";

            $result = enviarMail($phpMailer, $mailTo, $mailSubject, $mailBody);
            $error = $result[0];
            $class = $result[1];
            //creem cookie perque apareixi la opcio d'inserir codi al formulari
            setcookie('emailSent', true, $expiracio);
            buildMessage($error, $class, 'recupera', '');
        } else {
            //usuari no trobat
            $error = $error_rec1;
            $tipus = 'error';
            showMessage($tipus, $error, $displayEliminar);
        }
        
        //inroducció de codi de recuperacio
    } else if ($usuari && $codiPost) {

        //seleccionar user
        $user = $userModel->selectUserByUsername($usuari)[0];

        //buscar codi per user id
        if ($userModel->comprovarCodi($codiPost, $user['id'])) {
            setcookie('permisCanviPass', true, time() + 3600);
            header('Location: newPass.php?id=' . $user['id']);
            exit();
        } else {
            $error = $error_rec2;
            showMessage($class, $error, $displayEliminar);
        }

    }
    //ni user ni codi
    else {
        $error = $error_g1;
        showMessage($class, $error, $displayEliminar);
    }
}

include 'view/recupera.vista.php';
