<?php
//Anna Escribano

require 'lib/reCaptcha/recaptchalib.php';
require 'lib/Hybridauth/autoload.php';
require 'lib/OAuth2/autoloader.php';

require "model/user.model.php";

require "controller/utils/validacio.controller.php";
require 'controller/utils/rutes.controller.php';

$userModel = new Usuari();

$ruta = transformarRutaAccess();
$pageTitle = $ruta;


switch ($ruta) {
    case 'logout':
        require "login.controller.php";
        logout();
        break;

    case 'github':
        require "social.controller.php";
        githubLogin($userModel);
        break;

    case 'deviantart':
        require "social.controller.php";
        deviantartLogin($userModel);
        break;

    case "registre":
        require "registre.controller.php";
        processarRegistre($userModel, $tipus, $missatge);
        include 'view/registre.vista.php';
        break;

    case "login":
        require "login.controller.php";
        processarLogin($userModel, $missatge);
        include 'view/login.vista.php';
        break;
    default:
        break;
}
