<?php
// Anna Escribano


require "model/user.model.php";



$articles = null;

$privat = $_GET["myArticles"] ?? false;



//comprovem tant si esta logat com si esta a seccio propia, aixi no permetem que ningú
//inserti manualment "myArticles" a la URL
if ($privat && isset($_SESSION['user'])) {

    $pageTitle = "Els meus articles";
    $hiddenButton = "";

    $articles = $articleModel->selectArticleByUser($_SESSION['user_id']) ?? null;
} else {
    $pageTitle = "Home";

    $articleName = $_POST['buscadorArticle'] ?? null;

    //seleccionem tots o per nom
    $articles = $articleName ?
        $articleModel->selectArticleByName($articleName) :
        $articleModel->selectArticles();
}





