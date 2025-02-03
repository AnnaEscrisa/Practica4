<?php
//Anna Escribano
require_once 'vendor/autoload.php';

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
    case 'articles_form':
        require 'controller/articles/articles.controller.php';
        break;
    case 'login':
    case 'registre':
        require "controller/access/access.controller.php";
        break;

    case 'recuperacio':
    case 'new_pass':
        require 'controller/profile/profile.controller.php';
        break;
    case 'admin':
        require 'controller/admin/admin.controller.php';
        break;
    case 'profile':
        require 'controller/profile/profile.controller.php';
        break;
    case 'about':
        $pageTitle = 'about';
        include 'view/about.vista.php';
        break;
    case 'qr':
        require 'controller/qr/qr.controller.php';
        break;
    case 'contacte':
        $pageTitle = 'contact';
        include 'view/contact.vista.php';
        break;
    case 'materials':
        $pageTitle = 'materials';
        include 'view/materials.vista.php';
        break;
    case 'api':
        require 'api/index.php';
        break;

    default:
        http_response_code(404);
        break;
}
