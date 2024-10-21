<?php
// Anna Escribano

require "model/article.model.php";

$articleModel = new Article();
$pageTitle = "Nou Article";
$titol = ""; //titol actual de l'article
$cos = ""; //cos actual de l'article
$ingredients = ""; //ingredients actuals
$user_id = ""; //id de l-usuari creador
$id = ""; //id actual de l'article

$ruta = "form";
$sessioIniciada = isset($_SESSION['user']);


//mostrem error actual si hi ha
showMessage($tipus, $missatge, $displayEliminar);


//*------------------- Carregar mode edició -----------------------

//comprovem si estem en mode edició
$isEdit = $_GET["isEdit"] ?? false;

if ($isEdit && $sessioIniciada) {
    $id = $_GET["id"];
    $article = $articleModel->selectArticleById($id);

    //comprovem si l'article existeix, per si algun llest de torn canvia manualment l'id de l'article a la url
    if (!$article) {
        $error = $error_a4;
        showMessage($class, $error, $displayEliminar);
    } else {
        //si l'article existeix, establirem el valor dels inputs automaticament
        $article = $article[0];
        $pageTitle = "Editar article - " . $article["id"];
        $titol = $article["titol"];
        $cos = $article["cos"];
        $ingredients = $article["ingredients"];
        $user_id = $article["users_id"];
    }
}

//*--------------------- Carregar mode eliminació----------------

//comprovem si estem en mode eliminació
$isDelete = $_GET["isDelete"] ?? false;

if ($isDelete && $sessioIniciada) {
    $id = $_GET["id"];
    $article = $articleModel->selectArticleById($id);

    if (!$article) {
        $error = $error_a4;
        showMessage($class, $error, $displayEliminar);
    } else {

        //carreguem l'article perque l'usuari vegi quin article elimina
        $article = $article[0];
        $pageTitle = "Eliminar article - " . $article["id"];
        $titol = $article["titol"];
        $cos = $article["cos"];
        $ingredients = $article["ingredients"];
        $user_id = $article["user_id"];

        $error = $error_g3;
        $previousParams = "id=$id";
        $displayEliminar = "";

        showMessage($class, $error, $displayEliminar);
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
        $ruta = "index";
        buildMessage($error, $class, $ruta, "");
    }

    //*---- entrada pel formulari d'edicio/inserció
    if ($nouCos && $nouTitol) {

        //si estem editant
        if ($id) {
            $result = getInitialArticleValidation($nouTitol, $nouCos, $nousIngredients);
            if (!$result) {
                $result = $articleModel->updateArticle($id, $nouTitol, $nouCos, $nousIngredients);
            }

            $dadesMissatge = parseArticleError($result, 'edit');

            //comprovarà l'update i retornarà un missatge depenent del resultat
            $error = $dadesMissatge[0];
            $class = $dadesMissatge[1];

            //si estem creant un article nou
        } else {
            $result = getInitialArticleValidation($nouTitol, $nouCos, $nousIngredients);
           
            if (!$result) {
                $result = $articleModel->insertArticle($nouTitol, $nouCos, $user_id, $nousIngredients);
            }

            $dadesMissatge = parseArticleError($result, 'insert');

            $error = $dadesMissatge[0];
            $class = $dadesMissatge[1];
            if ($class == 'success') {

                //esborrem el valor dels inputs perque no surtin al form
                $nouCos = $nouTitol = $nousIngredients = '';
            }

        }

    } else {
        $error = $error_g1;
        $previousParams = $id ? "isEdit=true&id=$id" : "";
    }

    showMessage($class, $error, $displayEliminar);

}