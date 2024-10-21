<?php
// Anna Escribano

require "model/article.model.php";
require "model/user.model.php";
$articleModel = new Article();
$userModel = new Usuari();

$articles;//posteriorment omplenada amb articles

$hiddenButton = "hidden";//per ocultar els botons d'edicio/eliminacio
$privat = $_GET["myArticles"] ?? "";

//mostrem error actual si hi ha
showMessage($tipus, $missatge, $displayEliminar);


//comprovem tant si esta logat com si esta a seccio propia, aixi no permetem que ningú
//inserti manualment "myArticles" a la URL
if ($privat && isset($_SESSION['user'])) {

    $pageTitle = "Els meus articles";
    $hiddenButton = "";

    //seleccionem per usuari
    $articles = $articleModel->selectArticleByUser($_SESSION['user_id']);

} else {
    $pageTitle = "Home";

    $articleId = $_POST['buscadorArticle'] ?? null;

    //TODO que es pugui buscar per nom de article
    //seleccionem tots o per id
    $articles = $articleId ?
        $articleModel->selectArticleById($articleId) :
        $articleModel->selectArticles();
}

//*-------- Paginacio--------

$max_articles = 5;

$articlesMostrats = paginationChunks($max_articles, $articles);
$paginesData = getPagesData($articlesMostrats);


include 'view/home.vista.php'

?>