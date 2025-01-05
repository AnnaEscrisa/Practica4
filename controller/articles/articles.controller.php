<?php

require "model/article.model.php";

require 'controller/utils/rutes.controller.php';
require 'controller/utils/validacio.controller.php';
require 'controller/utils/image.controller.php';

$articleModel = new Article();


$ruta = transformarRutaArticle();
$pageTitle = $ruta;


switch ($ruta) {
    case 'home':
    case 'myArticles':
        require 'home.controller.php';
        require 'permis.controller.php';
        include 'controller/utils/pagination.controller.php';

        carregarArticles($articleModel, $missatge, $tipus, $displayEliminar);
        break;
    case 'editar':
        require 'permis.controller.php';
        require 'form.controller.php';

        $pageTitle = "Editar article";
        $article = carregarEdicio($articleModel, $missatge);
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
    case 'clonar':
        require 'permis.controller.php';
        require 'form.controller.php';

        $pageTitle = "Clonar article";
        $article = carregarEdicio($articleModel, $missatge);
        //llegir flags i deletejar camps no desitjats
        //processarEdicio($articleModel, $missatge, $tipus);

        include "view/form.vista.php";
        break;
    default:
        # code...
        break;
}

