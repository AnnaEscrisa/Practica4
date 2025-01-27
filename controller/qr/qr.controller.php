<?php

require_once 'vendor/autoload.php';

require 'controller/utils/rutes.controller.php';
require 'controller/utils/api.controller.php';
require 'lector.controller.php';
require 'creador.controller.php';

$ruta = transformarRutaQr();
$pageTitle = $ruta;


switch ($ruta) {
   
    case 'article':
        $qrCode = articleQr();
        echo $qrCode;
        break;
    case 'lector':
        readQr($missatge);
        include "view/qr.vista.php";
        break;
    default:
        # code...
        break;
}

