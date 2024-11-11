<?php
//Controla els diferents updates de les dades de l'usuari

require 'model/user.model.php';
$userModel = new Usuari();

$token = $_GET['token'] ?? '';
$user_id = $_GET['id'] ?? '';
//$ruta = $_GET

//!CANVIAR qeu miri si hi ha token i user id, i si esta entrara 
//nomes permet entrar si la cookie esta settejada, sino mostrarà la pagina en blanc
if (isset($_COOKIE['permisCanviPass'])) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $contrasenya = $_POST['password'];
        $repeticioContrasenya = $_POST['passwordRepeat'];

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

                //cokie unset perque no permeti més canvis
                setcookie('permisCanviPass', false, time() - 3600);
                setcookie('emailSent', false, time() - 3600);

                //com no hi ha errors, donarem missatge d'exit a l'index
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
