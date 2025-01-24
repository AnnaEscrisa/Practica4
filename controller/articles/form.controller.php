<?php
// Anna Escribano

function carregarEdicio($articleModel, &$missatge)
{
    $edit = $_GET['isEdit'] ?? false;
    $clone = $_GET['isClone'] ?? false;

    if ($edit) {
        $permisCanvis = comprovarPermis($articleModel, 'edit');

    } elseif ($clone) {
        $permisCanvis = comprovarPermis($articleModel, 'clone');
    }

    if ($permisCanvis) {
        $id = $_GET["id"] ?? '';

        $article = $articleModel->selectArticleById($id);

        //comprovem si l'article existeix, per si algun llest de torn canvia manualment l'id de l'article a la url
        if (!$article) {
            $missatge = error_a4;
        } else {
            $article = $article[0];
        }
    } else {
        buildMessage(error_a5, "error", "home", "");
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
    $permisCanvis = comprovarPermis($articleModel, 'delete');

    if ($permisCanvis) {
        $id = $_GET["id"] ?? '';

        $article = $articleModel->selectArticleById($id);
        if ($article) {
            $articleModel->deleteArticle($id);
            buildMessage(success_g1, "success", "home", "");
        }
        buildMessage(error_a4, "error", "home", "");

    } else {
        buildMessage(error_g6, "error", "home", "");
    }
}

function processarEdicio($articleModel, &$missatge, &$tipus)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $id = $_POST['id'] ?? false;
        $nouCos = $_POST["nouCos"] ?? false;
        $nouTitol = $_POST["nouTitol"] ?? false;
        $nousIngredients = $_POST["nousIngredients"] ?? false;
        $novaImatge = $_FILES["imatge"] ?? false;

        if ($nouCos && $nouTitol && $id) {
            $img = processarImatge($missatge);
            if (!empty($novaImatge['name']) && $img) {

                getResult($nouTitol, $nouCos, $nousIngredients, 'edit', $img, $articleModel, $missatge, $id);

            } elseif (empty($novaImatge['name'])) {

                getResult($nouTitol, $nouCos, $nousIngredients, 'edit', null, $articleModel, $missatge, $id);
            }

        } else {
            $missatge = error_g1;
        }
    }
}

function insertarArticle($articleModel, &$missatge, &$tipus, &$displayEliminar)
{
    $permisCanvis = comprovarPermis($articleModel, 'nou');

    if ($permisCanvis) {
        $pageTitle = 'Nou Article';
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $nouCos = $_POST["nouCos"] ?? false;
            $nouTitol = $_POST["nouTitol"] ?? false;
            $nousIngredients = $_POST["nousIngredients"] ?? false;
            $novaImatge = $_FILES["imatge"] ?? false;
            $user_id = $_SESSION['user_id'];
            if ($nouCos && $nouTitol) {

                $img = processarImatge($missatge);
                if (!empty($novaImatge['name']) && $img) {

                    getResult($nouTitol, $nouCos, $nousIngredients, 'insert', $img, $articleModel, $missatge, $user_id);

                } elseif (empty($novaImatge['name'])) {
                    getResult($nouTitol, $nouCos, $nousIngredients, 'insert', null, $articleModel, $missatge, $user_id);
                }
            } else {
                $missatge = error_g1;
            }
        }
        include "view/form.vista.php";
    } else {
        buildMessage(error_g6, "error", "home", "");
    }

}

function llegirFlags($article)
{
    $flags = $_GET;
    foreach ($flags as $key => $value) {
        if ($value == true) {
            unset($article[$key]);
        }
    }
    return $article;
}

function getResult($titol, $cos, $ingred, $operacio, $img, $articleModel, &$missatge, $id)
{
    $result = getInitialArticleValidation($titol, $cos, $ingred);
    if (!$result) {
        if ($operacio == "insert") {
            $result = $articleModel->insertArticle($titol, $cos, $id, $ingred);
            $id = $articleModel->getLastId();
        }
        if ($img) {
            $img = uploadImatge($id, $img, 'article');
        } else {
            $img = $_POST["imatgePrevia"];
        }
        $result = $articleModel->updateArticle($id, $titol, $cos, $ingred, $img);
    }

    $dadesMissatge = parseArticleError($result, $operacio);

    $missatge = $dadesMissatge[0];
    $tipus = $dadesMissatge[1];
    if ($tipus == 'success') {
        buildMessage(success_a1, $tipus, "home", "myArticles=true");
    }
}

