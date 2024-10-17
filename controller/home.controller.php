<?php
// Anna Escribano

require "model/article.model.php";
$articleModel = new Article();
$articles;

$hiddenButton = "hidden";//per ocultar els botons d'edicio/eliminacio
$privat = $_GET["myArticles"] ?? "";

//mostrem error actual si hi ha
showMessage($tipus, $missatge, $displayEliminar);


//comprovem tant si esta logat com si esta a seccio propia, aixó no permetem que ningú
//inserti manualment "myArticles" a la URL
if ($privat && isset($_SESSION['user'])) {

    $pageTitle = "Els meus articles";
    $hiddenButton = "";

    $user = $_SESSION['user'];
    $articles = $articleModel->selectArticleByUser($user);

} else {
    $pageTitle = "Home";

    $articleId = $_POST['buscadorArticle'] ?? null;
    $articles = $articleId ?
        $articleModel->selectArticleById($articleId) :
        $articleModel->selectArticles();
}

?>