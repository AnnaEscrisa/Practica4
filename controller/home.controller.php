<?php
// Anna Escribano
include 'utils/pagination.controller.php';
require "model/article.model.php";
require "model/user.model.php";
$articleModel = new Article();
$userModel = new Usuari();

$articles;//posteriorment omplenada amb articles

$hiddenButton = "hidden";//per ocultar els botons d'edicio/eliminacio
$privat = $_GET["myArticles"] ?? false;


//comprovem tant si esta logat com si esta a seccio propia, aixi no permetem que ningú
//inserti manualment "myArticles" a la URL
if ($privat && isset($_SESSION['user'])) {

    $pageTitle = "Els meus articles";
    $hiddenButton = "";

    //seleccionem per usuari
    $articles = $articleModel->selectArticleByUser($_SESSION['user_id']) ?? null;

} else {
    $pageTitle = "Home";

    //!OJO si possem que es null, mai ens mostrara el missateg de "no hi per mostrar" quan passem un nom incorrecte o inexistent
    $articleName = $_POST['buscadorArticle'] ?? null;

    //seleccionem tots o per nom
    $articles = $articleName ?
        $articleModel->selectArticleByName($articleName) :
        $articleModel->selectArticles();
}

//*-------- Paginacio--------

//maxim d'articles escollits per l'usuari, o els guardats a la cookie. Sino, 5 per defecte
$max_articles = $_POST['selectPagines'] ?? $_COOKIE['paginacio']?? 5;
setcookie('paginacio', $max_articles);

$articlesMostrats = paginationChunks($max_articles, $articles);
$paginesData = getPagesData($articlesMostrats);


include 'view/home.vista.php'

?>