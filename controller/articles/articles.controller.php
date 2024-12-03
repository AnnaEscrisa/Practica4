<?php

require "model/article.model.php";

require 'controller/utils/rutes.controller.php';
require 'controller/utils/validacio.controller.php';

$articleModel = new Article();


$ruta = transformarRutaArticle();
$pageTitle = $ruta;


switch ($ruta) {
    case 'home':
        require 'home.controller.php';
        include 'controller/utils/pagination.controller.php';

        $pageTitle = "Home";

        $articleName = $_POST['buscadorArticle'] ?? null;

        //seleccionem tots o per nom
        $articles = $articleName ?
            $articleModel->selectArticleByName($articleName) :
            $articleModel->selectArticles();
        $max_articles = $_POST['selectPagines'] ?? $_COOKIE['paginacioHome'] ?? 5;
        $ordenacio_art = $_POST['selectOrder'] ?? $_COOKIE['order_art'] ?? 'titol';


        setHomeCookies($max_articles, $ordenacio_art);

        ordenarArticles($articles, $ordenacio_art);


        $articlesMostrats = $articles ? paginationChunks($max_articles, $articles) : null;
        $paginesData = getPagesData($articlesMostrats, "home") ?? null;
        $hiddenButton = "hidden"; //per ocultar els botons d'edicio/eliminacio

        include 'view/home.vista.php';
        break;
    case 'myArticles':
        require 'home.controller.php';
        include 'controller/utils/pagination.controller.php';
        $pageTitle = "Els meus articles";
        $articles = $articleModel->selectArticleByUser($_SESSION['user_id']) ?? null;
        # code...
        include 'view/home.vista.php';
        break;
    case 'editar':
        require 'permis.controller.php';
        $pageTitle = "Editar article";
        carregarEdicio($articleModel);
        processarEdicio($articleModel, $missatge, $tipus);
        //a vista s'harua de 
        # code...
        include "view/form.vista.php";
        break;
    case 'eliminar':
        require 'permis.controller.php';
        # code...
        include "view/form.vista.php";
        break;
    case 'nou':
        # code...
        include "view/form.vista.php";
        break;
    default:
        # code...
        break;
}

