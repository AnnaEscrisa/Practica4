<?php


function comprovarPermis($articleModel){
    $permisCanvis = false;
    $currentUser = $_SESSION['user_id'] ?? false;
    $id = $_GET["id"] ?? '';

    if ($currentUser && $id) {
        $permisCanvis = comprovarPossesioArticle($articleModel, $currentUser, $id);
    } 
    else if ($currentUser) {
        $permisCanvis = true;
    }
    else {
        buildMessage(error_a5, "error", 'login', "");
    }
    
    if (!$permisCanvis) {
        buildMessage(error_a5, "error", 'home', "");
    }
    return $permisCanvis;
}

function comprovarPossesioArticle($articleModel, $currentUser, $articleId)
{
    $articles = $articleModel->selectArticleByUser($currentUser);

    $articlesIds = array_column($articles, 'id');

    return in_array($articleId, $articlesIds);
}