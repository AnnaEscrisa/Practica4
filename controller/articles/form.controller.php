<?php
// Anna Escribano

function carregarEdicio($articleModel)
{
    $permisCanvis = comprovarPermis($articleModel);

    if ($permisCanvis) {
        $id = $_GET["id"] ?? '';

        $article = $articleModel->selectArticleById($id);

        //comprovem si l'article existeix, per si algun llest de torn canvia manualment l'id de l'article a la url
        if (!$article) {
            $missatge = error_a4;
        } else {
            $article = $article[0];
        }
    }
    return $article;
}

function parsejarPropietats($article)
{
    //turn article properties into array keys
    return get_object_vars($article);
    // return $articleArray;
    // $titol = $article["titol"];
    // $cos = $article["cos"];
    // $ingredients = $article["ingredients"];
    // $user_id = $article["user_id"];
}


function eliminarArticle($articleModel)
{
    $permisCanvis = comprovarPermis($articleModel);

    if ($permisCanvis) {
        $id = $_GET["id"] ?? '';

        $article = $articleModel->selectArticleById($id);
        if ($article) {
            $articleModel->deleteArticle($id);
            buildMessage(success_g1, "success", "home", "");
        }
        buildMessage(error_a4, "error", "home", "");

    } else {

    }
}

function processarEdicio($articleModel, &$missatge, &$tipus)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $permisCanvis = comprovarPermis($articleModel);
        if (!$permisCanvis) buildMessage();

        $id = $_POST['id'] ?? false;
        $nouCos = $_POST["nouCos"] ?? false;
        $nouTitol = $_POST["nouTitol"] ?? false;
        $nousIngredients = $_POST["nousIngredients"] ?? false;

        if ($nouCos && $nouTitol && $id) {
            $result = getInitialArticleValidation($nouTitol, $nouCos, $nousIngredients);
            if (!$result) {

                $result = $articleModel->updateArticle($id, $nouTitol, $nouCos, $nousIngredients);
            }

            $dadesMissatge = parseArticleError($result, 'edit');
            $missatge = $dadesMissatge[0];
            $tipus = $dadesMissatge[1];

            if ($tipus == 'success') {

                buildMessage(success_a2, $tipus, "home", "myArticles=true");
            }
        } else {
            $missatge = error_g1;
        }
    }
}

function insertarArticle($articleModel, &$missatge, &$tipus, &$displayEliminar)
{
    $pageTitle = 'Nou Article';
    $nouTitol = $nouCos = $nousIngredients = $user_id = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $nouCos = $_POST["nouCos"] ?? false;
        $nouTitol = $_POST["nouTitol"] ?? false;
        $nousIngredients = $_POST["nousIngredients"] ?? false;
        $user_id = $_SESSION['user_id'];

        if ($nouCos && $nouTitol) {
            $result = getInitialArticleValidation($nouTitol, $nouCos, $nousIngredients);

            if (!$result) {
                $result = $articleModel->insertArticle($nouTitol, $nouCos, $user_id, $nousIngredients);
            }

            $dadesMissatge = parseArticleError($result, 'insert');

            $missatge = $dadesMissatge[0];
            $tipus = $dadesMissatge[1];
            if ($tipus == 'success') {

                buildMessage(success_a1, $tipus, "home", "myArticles=true");
            }
        } else {
            $missatge = error_g1;
        }
    }
    include "view/form.vista.php";

}
