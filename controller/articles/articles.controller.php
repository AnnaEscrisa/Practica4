<?php


function eliminarArticle($articleModel)
{
    $eliminacio = $_POST["elimina"] ?? false;
    if ($eliminacio) {
        $id = $_GET["id"];
        $articleModel->deleteArticle($id);
        buildMessage(success_g1, "success", "home", "");
    }
}

function editarArticle($articleModel, $id, &$missatge, &$tipus)
{
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
    }
}

function insertarArticle($articleModel, &$missatge, &$tipus)
{
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
    }
}

?>