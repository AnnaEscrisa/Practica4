<?php
// Anna Escribano

//Controla l'insercio i edicio d'articles
require 'utils/validacio.controller.php';
require "model/article.model.php";
$articleModel = new Article();

$pageTitle = "Nou Article";
$titol = ""; 
$cos = ""; 
$ingredients = ""; 
$user_id = ""; 

$ruta = "articles_form";

$permisCanvis = false;
$currentUser = $_SESSION['user_id'] ?? false;

//mostrem error actual si hi ha


$id = $_GET["id"] ?? '';
$isEdit = $_GET["isEdit"] ?? false;
$isDelete = $_GET["isDelete"] ?? false;

//nomes els usuaris logats poden crear, modificar o eliminar
if ($currentUser){
    $articles = $articleModel->selectArticleByUser($currentUser);
    
    $articlesIds = array_flip(array_column($articles, 'id'));
    
    //comprovem si aquest article es de l'usuari
    $permisCanvis = $articlesIds[$id] === null ? true : false;
}  else {
    buildMessage($error_a6, $class, 'login', "");
}

if (($isEdit || $isDelete) && !$permisCanvis) {
    buildMessage($error_a5, $class, $ruta, "");
}

//*------------------- Carregar mode edició -----------------------

//comprovem si estem en mode edició i tenim permis

if ($isEdit && $permisCanvis) {
    $article = $articleModel->selectArticleById($id);

    //comprovem si l'article existeix, per si algun llest de torn canvia manualment l'id de l'article a la url
    if (!$article) {
        $missatge = $error_a4;
    } else {
        //si l'article existeix, establirem el valor dels inputs automaticament
        $article = $article[0];
        $pageTitle = "Editar article - " . $article["id"];
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
        $missatge = $error_a4;
        $tipus = 'error';
    } else {

        //carreguem l'article perque l'usuari vegi quin article elimina
        $article = $article[0];
        $pageTitle = "Eliminar article - " . $article["id"];
        $titol = $article["titol"];
        $cos = $article["cos"];
        $ingredients = $article["ingredients"];
        $user_id = $article["user_id"];

        $missatge = $error_g3;
        $tipus = 'error';
        $displayEliminar = "";
    }
}

//*--------------------Inserir/editar/eliminar ---------------

//només s'executarà si s'ha enviat un formulari
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nouCos = $_POST["nouCos"] ?? false;
    $nouTitol = $_POST["nouTitol"] ?? false;
    $nousIngredients = $_POST["nousIngredients"] ?? false;
    $user_id = $_POST["user_id"] ?? false;
    $eliminacio = $_POST["elimina"] ?? false;

    //*---- entrada pel formulari d'eliminació
    //eliminarà l'article i redireccionarà a Home amb un missatge
    if ($eliminacio) {
        $id = $_GET["id"];
        $articleModel->deleteArticle($id);
        $error = $success_g1;
        $class = "success";
        $ruta = "home";
        buildMessage($error, $class, $ruta, "");
    }

    //*---- entrada pel formulari d'edicio/inserció
    if ($nouCos && $nouTitol) {

        //si estem editant
        if ($id) {

            //validacio inicial
            $result = getInitialArticleValidation($nouTitol, $nouCos, $nousIngredients);
            if (!$result) {
                //validacio al model
                $result = $articleModel->updateArticle($id, $nouTitol, $nouCos, $nousIngredients);
            }

            //comprovarà l'update i retornarà un missatge depenent del resultat
            $dadesMissatge = parseArticleError($result, 'edit');

            $missatge = $dadesMissatge[0];
            $tipus = $dadesMissatge[1];
            

        }
        //si estem creant un article nou
        else {
            $result = getInitialArticleValidation($nouTitol, $nouCos, $nousIngredients);

            if (!$result) {
                $result = $articleModel->insertArticle($nouTitol, $nouCos, $user_id, $nousIngredients);
            }

            $dadesMissatge = parseArticleError($result, 'insert');

            $missatge = $dadesMissatge[0];
            $tipus = $dadesMissatge[1];
            if ($tipus == 'success') {

                //esborrem el valor dels inputs perque no surtin al form
                $nouCos = $nouTitol = $nousIngredients = '';
            }
        }
    }
    //si no hi ha inputs de l'usuari 
    else {
        $missatge = $error_g1;
        $previousParams = $id ? "isEdit=true&id=$id" : "";
    }

    //! OJO ESTO

    //ensenya missatge amb errors de edit o insert
    showMessage($tipus, $missatge, $displayEliminar);
}
include "view/form.vista.php";

?>