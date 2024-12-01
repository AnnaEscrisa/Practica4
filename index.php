<?php
//Anna Escribano

require 'config.php';
require 'controller/utils/message.controller.php';
require 'controller/utils/session.controller.php';

comprovarActivitat(SESSION_TIMEOUT);
registrarActivitat();

$route = $_GET['route'];
$route = explode('/', $route)[0];

switch ($route) {
    case '':
    case 'home':
        require 'controller/home/home.controller.php';
        break;
    case 'login':
    case 'registre':
        require "controller/access/access.controller.php";
        break;
    case 'articles_form':
        require 'controller/articles/form.controller.php';
        break;
    case 'profile':
    case 'recuperacio':
    case 'new_pass':
        require 'controller/profile/profile.controller.php';
        break;
    case 'users':
        require 'controller/users/users.controller.php';
        break;

    default:
        http_response_code(404);
        break;
}

?>