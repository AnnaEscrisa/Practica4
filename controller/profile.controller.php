<?php
//Controla els diferents updates de les dades de l'usuari
require 'utils/validacio.controller.php';
require 'model/user.model.php';
$userModel = new Usuari();

$token = $_GET['token'] ?? '';
$user_id = $_GET['id'] ?? '';
//$ruta = $_GET

if ($token && $user_id) {

    if ($userModel->comprovarCodi($token, $user_id)) {

        include 'view/newPass.vista.php';
    } else {
        $error = $error_rec2;
        showMessage($class, $error, $displayEliminar);
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $contrasenya = $_POST['password'];
    $repeticioContrasenya = $_POST['passwordRepeat'];
    $oldContrasenya = $_POST['old_password'];
    $isUpdate = $_GET['isUpdate'] ?? '';

    if ($isUpdate) {
       
    }

    //si rebem tot el necessari del form
    if ($contrasenya && $repeticioContrasenya) {

        //validem les contrasenyes
        if (!mateixaContrasenya($contrasenya, $repeticioContrasenya)) {
            $error = $error_r3;
        } else if (!contrasenyaSegura($contrasenya)) {
            $error = $error_r5;
        } else {

            $valors = password_hash($contrasenya, PASSWORD_DEFAULT);

            $userModel->updateUsuari($user_id, [$valors], 'password = ?');

            //com no hi ha errors, donarem missatge d'exit a l'index
            $error = $success_rec2;
            $classe = 'success';
            $ruta = 'home';
            buildMessage($error, $classe, $ruta, '');
        }
    } else {
        //si no ha introduit dades
        $error = $error_g1;
        $previousParams = "$reset=true&id=$user_id";

    }
    buildMessage($error, $classe, $ruta, $previousParams);
}

include 'view/newPass.vista.php';







//TODO canvi de contrasenya des de perfil d'usuari

//TODO canvi dades usuari
