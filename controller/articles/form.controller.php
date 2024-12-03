<?php
// Anna Escribano



$titol = "";
$cos = "";
$ingredients = "";
$user_id = "";
$pageTitle = "";

$ruta = "articles_form";


$id = $_GET["id"] ?? '';
$isEdit = $_GET["isEdit"] ?? false;
$isDelete = $_GET["isDelete"] ?? false;




function carregarEdicio($articleModel)
{
    $isEdit = $_GET["isEdit"] ?? false;
    $permisCanvis = comprovarPermis($articleModel, $isEdit);

    if ($isEdit && $permisCanvis) {
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



function eliminarArticle($articleModel)
{
    $eliminacio = $_POST["elimina"] ?? false;
    if ($eliminacio) {
        $id = $_GET["id"];
        $articleModel->deleteArticle($id);
        buildMessage(success_g1, "success", "home", "");
    }
}

function processarEdicio($articleModel, &$missatge, &$tipus)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $id = $_POST['id'] ?? false;
        $nouCos = $_POST["nouCos"] ?? false;
        $nouTitol = $_POST["nouTitol"] ?? false;
        $nousIngredients = $_POST["nousIngredients"] ?? false;

        if ($nouCos && $nouTitol && $id) {
            $result = getInitialArticleValidation($nouTitol, $nouCos, $nousIngredients);
            if (!$result) {

                $result = $articleModel->updateArticle($id, $nouTitol, $nouCos, $nousIngredients);
            }

            //comprovarà l'update i retornarà un missatge depenent del resultat
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

function insertarArticle($articleModel, &$missatge, &$tipus)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $nouCos = $_POST["nouCos"] ?? false;
        $nouTitol = $_POST["nouTitol"] ?? false;
        $nousIngredients = $_POST["nousIngredients"] ?? false;
        $user_id = $_POST["user_id"] ?? false;

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
}
