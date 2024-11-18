<?php
//Anna Escribano

require 'config.php';
require 'controller/utils/message.controller.php';
require 'controller/utils/session.controller.php';

comprovarActivitat(SESSION_TIMEOUT);
registrarActivitat();

$route = $_GET['route'];

switch ($route) {
    case '':
    case 'home':
        require 'controller/home.controller.php';
        break;
    case 'login':
        require "controller/access.controller.php";
        include 'view/login.vista.php';
        break;
    case 'register':
    case 'registre':
        require "controller/access.controller.php";
        include 'view/registre.vista.php';
        break;
    case 'articles_form':
        require 'controller/form.controller.php';
        break;
    case 'recuperacio':
        require 'controller/recuperacio.controller.php';
        break;
    case 'regeneracio':
        require 'controller/profile.controller.php';
        break;
    case 'users':
        require 'controller/users.controller.php';
        break;
    case 'profile':
    default:
        http_response_code(404);
        break;
}

// enrutar('home', 'home.controller', homeIndex());

// function enrutar($ruta, $controller, $funcio) {
//     $route = $_GET['route'];

//     if ($route === $ruta) {
//         require "controller/$controller.php";
//         $funcio;
//     }

// }

?>