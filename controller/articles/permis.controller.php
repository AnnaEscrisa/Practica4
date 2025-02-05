<?php


function comprovarPermis($articleModel, $accio)
{
    $permisCanvis = false;
    $currentUser = $_SESSION['user_id'] ?? false;
    $id = $_GET["id"] ?? '';

    switch ($accio) {
        case 'edit':
            $permisCanvis = comprovarPossesioArticle($articleModel, $currentUser, $id);
            break;

        case 'delete':
            $permisCanvis = comprovarPossesioArticle($articleModel, $currentUser, $id);
            break;

        case 'nou':
            $permisCanvis = $currentUser ? true : false;

        case 'clone':
            $permisCanvis = $currentUser ? true : false;
            break;
        default:
            break;
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