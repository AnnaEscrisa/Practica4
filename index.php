<?php
//Anna Escribano
// require 'controller/utils/message.controller.php';
// require 'controller/utils/session.controller.php';

require 'controller/utils/message.controller.php';
require 'controller/utils/session.controller.php';
include 'controller/utils/pagination.controller.php';
require 'controller/home.controller.php';

// $route = $_GET['route'] ?? 'home';

// switch ($route) {
//     case 'home':
//         include 'controller/utils/pagination.controller.php';
//         require 'controller/home.controller.php';
//         break;
//     case 'login':
//     case 'registre':
//         require 'controller/utils/validacio.controller.php';
//         require "controller/access.controller.php";
//     case 'form':
//         require 'controller/utils/validacio.controller.php';
//         require 'controller/form.controller.php';
//         include 'view/form.vista.php';
//         break;
//     case 'recupera':
//         require 'controller/utils/mailer.controller.php';
//         require 'controller/recuperacio.controller.php';
//     case 'newPass':
//         require 'controller/utils/validacio.controller.php';
//         require 'controller/profile.controller.php';
//     case 'users':
//     case 'profile':
//     default:

//         break;
// }

?>