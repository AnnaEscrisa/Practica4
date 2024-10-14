<?php
// Anna Escribano

require "model/article.model.php";

$pageTitle = "Home";
$articleModel = new Article();
$hiddenButton = "";//per ocultar els botons d'edicio/eliminacio

//mostrem error actual si hi ha
showMessage($tipus, $missatge, $displayEliminar);


//! ALERTA si els articles nomes son els del usuari, que no deixi
//! buscar per id un que no sigui seu

//obtenim articleId buscat per l'usuari (si hi ha)
$articleId = $_POST['buscadorArticle'] ?? null;

//! mirar de fer un filtre per articleID, filtrar per usuari


//si hi ha usuari, mostrarem els seus articles; sino, tots
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $articles = $articleModel->selectArticleByUser($user);
} else {

    $articles = $articleId ?
        $articleModel->selectArticleById($articleId) :
        $articleModel->selectArticles();
}





?>