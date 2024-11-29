<?php
// Anna Escribano

//Controla l'insercio i edicio d'articles
require 'controller/utils/validacio.controller.php';
require 'permis.controller.php';
require 'articles.controller.php';
require "model/article.model.php";
$articleModel = new Article();


$titol = "";
$cos = "";
$ingredients = "";
$user_id = "";
$pageTitle = "";

$ruta = "articles_form";


$id = $_GET["id"] ?? '';
$isEdit = $_GET["isEdit"] ?? false;
$isDelete = $_GET["isDelete"] ?? false;

//nomes els usuaris logats poden crear, modificar o eliminar
$permisCanvis = comprovarPermis($articleModel, $isEdit, $isDelete);


//*------------------- Carregar mode edició -----------------------

//comprovem si estem en mode edició i tenim permis

if ($isEdit && $permisCanvis) {
    $pageTitle = "Editar article";

    $article = $articleModel->selectArticleById($id);

    //comprovem si l'article existeix, per si algun llest de torn canvia manualment l'id de l'article a la url
    if (!$article) {
        $missatge = error_a4;
    } else {
        //si l'article existeix, establirem el valor dels inputs automaticament
        $article = $article[0];
        $titol = $article["titol"];
        $cos = $article["cos"];
        $ingredients = $article["ingredients"];
        $user_id = $article["user_id"];
    }
}

//*--------------------- Carregar mode eliminació----------------

//comprovem si estem en mode eliminació

if ($isDelete && $permisCanvis) {
    $article = $articleModel->selectArticleById($id);

    if (!$article) {
        $missatge = error_a4;
    } else {

        //carreguem l'article perque l'usuari vegi quin article elimina
        $article = $article[0];
        $pageTitle = "Eliminar article - " . $article["id"];
        $titol = $article["titol"];
        $cos = $article["cos"];
        $ingredients = $article["ingredients"];
        $user_id = $article["user_id"];

        $missatge = error_g3;
        $displayEliminar = "";
    }
}

//*--------------------Inserir/editar/eliminar ---------------

//només s'executarà si s'ha enviat un formulari
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nouCos = $_POST["nouCos"] ?? false;
    $nouTitol = $_POST["nouTitol"] ?? false;

    //*---- entrada pel formulari d'eliminació

    eliminarArticle($articleModel);

    //*---- entrada pel formulari d'edicio/inserció

    editarArticle($articleModel, $id, $missatge, $tipus);

    insertarArticle($articleModel, $missatge, $tipus);

    //si no hi ha inputs de l'usuari 
    if (!$nouCos || !$nouTitol) {
        $missatge = error_g1;
    }
}

include "view/form.vista.php";

?>