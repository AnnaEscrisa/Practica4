<?php

use Backend\Model\Article;

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

        carregarArticles($articleModel, $missatge, $tipus);
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

        $pageTitle = 'Nou Article';
        
        insertarArticle($articleModel);
        processarInsercio($articleModel, $missatge, $tipus);
        include "view/form.vista.php";
        break;
    case 'clonar':
        require 'permis.controller.php';
        require 'form.controller.php';

        $pageTitle = "Clonar article";
        $article = carregarEdicio($articleModel, $missatge);
        $article = llegirFlags($article);
        processarInsercio($articleModel, $missatge, $tipus);

        include "view/form.vista.php";
        break;
    default:
        # code...
        break;
}

