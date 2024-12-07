<?php

require "model/article.model.php";

require 'controller/utils/rutes.controller.php';
require 'controller/utils/validacio.controller.php';

$articleModel = new Article();


$ruta = transformarRutaArticle();
$pageTitle = $ruta;


switch ($ruta) {
    case 'home':
    case 'myArticles':
        require 'home.controller.php';
        include 'permis.controller.php';
        include 'controller/utils/pagination.controller.php';

        carregarArticles($articleModel, $missatge, $tipus, $displayEliminar);
        break;
    case 'editar':
        require 'permis.controller.php';
        require 'form.controller.php';

        $pageTitle = "Editar article";
        $article = carregarEdicio($articleModel);
        processarEdicio($articleModel, $missatge, $tipus);
       
        include "view/form.vista.php";
        break;
    case 'eliminar':
        require 'permis.controller.php';
        require 'form.controller.php';
        eliminarArticle($articleModel);
        break;
    case 'nou':
        require 'permis.controller.php';
        require 'form.controller.php';
        insertarArticle($articleModel, $missatge, $tipus, $displayEliminar);
        break;
    default:
        # code...
        break;
}

