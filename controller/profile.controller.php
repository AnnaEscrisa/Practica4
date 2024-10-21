<?php
//Controla els diferents updates de les dades de l'usuari

require 'model/user.model.php';
$userModel = new Usuari();

$user_id = $_GET['id'] ?? '';

if (isset($_COOKIE['permisCanviPass'])) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $contrasenya = $_POST['password'];
        $repeticioContrasenya = $_POST['passwordRepeat'];

        if ($contrasenya && $repeticioContrasenya) {

            //validem les contrasenyes
            if (!mateixaContrasenya($contrasenya, $repeticioContrasenya)) {
                $error = $error_r3;
            } else if (!contrasenyaSegura($contrasenya)) {
                $error = $error_r5;
            } else {
                
                $valors = password_hash($contrasenya, PASSWORD_DEFAULT);
                
                $userModel->updateUsuari($user_id, [$valors], 'password = ?');
                
                //cokie unset perque no permeti més canvis
                setcookie('permisCanviPass', time() - 3600);
                setcookie('emailSent', true, time() - 3600);

                $error = $success_rec2;
                $classe = 'success';
                $ruta = 'index';
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
}




//TODO canvi de contrasenya des de perfil d'usuari

//TODO canvi dades usuari
