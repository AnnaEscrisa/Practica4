<?php
//Anna Escribano

//Controla el login, logout, registre

require 'lib/reCaptcha/recaptchalib.php';
require "utils/validacio.controller.php";
require "model/user.model.php";
$userModel = new Usuari();
//treiem la ruta i pageTitle del nom d'aquest mateix arxiu
$ruta = array_slice(explode('/',$_SERVER["REQUEST_URI"]), -1)[0];

$pageTitle = $ruta;


//*------------- LOGOUT ---------

$isLogout = $_GET['isLogout'] ?? null;

//si cliquem a "logout", tancara la sessió i redireccionarà amb missatge
if ($isLogout) {
    session_unset();
    session_destroy();
    $error = $success_l2;
    $class = "success";
    buildMessage($error, $class, "home", "");
}


//*------------- LOGIN / REGISTRE ---------

$usuari = $_POST["usuari"] ?? null;
$contrasenya = $_POST["password"] ?? null;
$repeticioContrasenya = $_POST["passwordRepeat"] ?? null;
$nom = $_POST["nom"] ?? null;
$email = $_POST["email"] ?? null;
$recorda = $_POST["recorda"] ?? null;
$loginSubmit = $_POST["loginSubmit"] ?? null;
$recaptcha = $_POST['g-recaptcha-response'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //entrada per registre
    if ($usuari && $contrasenya && $repeticioContrasenya && $nom && $email) {

        //validacio inicial al controlador
        $result = getInitialUserValidation($usuari, $contrasenya, $repeticioContrasenya, $nom, $email);
        if (!$result) {
            //Validacio al model
            $result = $userModel->insertUsuari($usuari, $contrasenya, $nom, $email);
        }

        $dadesmissatge = parseUserError($result, "insert");
        $error = $dadesmissatge[0];
        $class = $dadesmissatge[1];
        $ruta = $class == "success" ? "home" : "registre";

        buildMessage($error, $class, $ruta, "");
    }

    // entrada per login
    //utilitzem loginSubmit per assegurar que esta intentant entrar pel form de login, i no el de registre
    if ($usuari && $contrasenya && $loginSubmit) {

        //nomes comprovarem el captcha si hi 3 intents de login
        if ($_COOKIE['intentsLogin'] >= 3 && !$recaptcha) {
            $error = $error_g1;
            buildMessage($error, $class, $ruta, $previousParams);
        }

        $login = $userModel->login($usuari, $contrasenya);
        if ($login) {

            if ($recorda) {
                setcookie("recorda", $usuari, time() + 10 * 24 * 60 * 60);
            }

            $_SESSION["user"] = $usuari;
            $user = $userModel->selectUserByUsername($usuari)[0];
            $_SESSION['user_id'] = $user['id'];

            setcookie('intentsLogin', 0);

            $error = $success_l1;
            $params = "myArticles=true";
            $class = 'success';
            buildMessage($error, $class, "home", $params);
        } else {
            $intentsLogin = $_COOKIE['intentsLogin'] ?? 0;
            setcookie('intentsLogin', 1 + $intentsLogin, time() + 10 * 60);
            
            $error = $error_l1;
            buildMessage($error, $class, "login", "");
        }
    }
   //submit sense inputs
    $error = $error_g1;
    buildMessage($error, $class, $ruta, $previousParams);

}

?>