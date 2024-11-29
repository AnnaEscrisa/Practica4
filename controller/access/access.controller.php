<?php
//Anna Escribano

require "model/user.model.php";

require "login.controller.php";
require "registre.controller.php";
require "social.controller.php";
require "controller/utils/validacio.controller.php";

require 'lib/reCaptcha/recaptchalib.php';
require 'lib/Hybridauth/autoload.php';


$userModel = new Usuari();

$ruta = array_slice(explode('/', $_SERVER["REQUEST_URI"]), -1)[0];
$pageTitle = $ruta;


switch ($ruta) {
    case 'login?isLogout=true':
        logout();
        break;

    case 'login?github=true':
        githubLogin($userModel);
        break;

    case "registre":
        processarRegistre($userModel, $tipus, $missatge);
        include 'view/registre.vista.php';
        break;

    case "login":
        processarLogin($userModel, $missatge);
        include 'view/login.vista.php';
        break;
    default:
        break;
}
