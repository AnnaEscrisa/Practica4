<?php
//Anna Escribano

require 'lib/reCaptcha/recaptchalib.php';
require 'lib/Hybridauth/autoload.php';
require 'lib/OAuth2/autoloader.php';

require "model/user.model.php";

require "login.controller.php";
require "registre.controller.php";
require "social.controller.php";
require "controller/utils/validacio.controller.php";
require 'controller/utils/rutes.controller.php';

$userModel = new Usuari();

$ruta = transformarRutaAccess();
$pageTitle = $ruta;


switch ($ruta) {
    case 'logout':
        logout();
        break;

    case 'github':
        githubLogin($userModel);
        break;

    case 'deviantart':
        deviantartLogin($userModel);
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
