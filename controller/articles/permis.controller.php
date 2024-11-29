<?php


function comprovarPermis($articleModel, $isEdit, $isDelete){
    $permisCanvis = false;
    $currentUser = $_SESSION['user_id'] ?? false;
    $id = $_GET["id"] ?? '';

    if ($currentUser) {

        $permisCanvis = comprovarPossesioArticle($articleModel, $currentUser, $id);
    } else {
        buildMessage(error_a5, "error", 'login', "");
    }
    
    if (($isEdit || $isDelete) && !$permisCanvis) {
        buildMessage(error_a5, "error", 'home', "");
    }
    return $permisCanvis;
}

function comprovarPossesioArticle($articleModel, $currentUser, $articleId)
{
    $articles = $articleModel->selectArticleByUser($currentUser);

    //! RESOLVER ALERTA
    $articlesIds = array_column($articles, 'id');

    return in_array($articleId, $articlesIds);
}