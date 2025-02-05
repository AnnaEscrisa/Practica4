<?php
// Anna Escribano

use Backend\Model\Usuari;

require 'permis.controller.php';
require 'users.controller.php';
require 'controller/utils/pagination.controller.php';
require 'controller/utils/rutes.controller.php';


comprovarPermisAdmin();

$userModel = new Usuari();
$ruta = transformarRutaAdmin();

switch ($ruta) {
    case 'admin':
        $pageTitle = "Usuaris";

        $data = carregarUsuaris($userModel);
        $usuarisMostrats = $data['usuarisMostrats'];
        $paginesData = $data['paginesData'];
        $max_users = $data['maxUsers'];
        include 'view/users.vista.php';
        break;

    default:
        # code...
        break;
}



