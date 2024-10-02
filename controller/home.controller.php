<?php
// Anna Escribano Sabio

require "model/article.model.php";

$pageTitle = "Home";
$articleModel = new Article();

//mostrem error actual si hi ha
showMessage($tipus, $missatge, $displayEliminar);

$articleId = $_POST['buscadorArticle'] ?? null;

//si l'usuari ha buscat un article, se li mostrarà, sino es mostraran tots
$articles = $articleId ?
    $articleModel->selectArticleById($articleId) :
    $articleModel->selectArticles();

?>