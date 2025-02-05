<?php

function carregarArticles($articleModel, $missatge, $tipus)
{
    $privat = $_GET["myArticles"] ?? false;
    $articleName = $_POST['buscadorArticle'] ?? null;

    if ($privat && isset($_SESSION['user'])) {
        $pageTitle = "Els meus articles";
        $hiddenButton = "";
        if ($articleName) {
            $possibleArticle = $articleModel->selectArticleByName($articleName);
            if ($possibleArticle && comprovarPossesioArticle($articleModel, $_SESSION['user_id'], $possibleArticle[0]['id'])) {
                $articles = $possibleArticle;
            } else {
                $articles = null;
            }
        } else {
            $articles = $articleModel->selectArticleByUser($_SESSION['user_id']) ?? null;
        }

    } else if (!$privat) {
        $pageTitle = "Home";
        $hiddenButton = 'hidden';
        $articles = $articleName ?
            $articleModel->selectArticleByName($articleName) :
            $articleModel->selectArticles();

    } else {
        buildMessage(error_g6, 'error', 'home', '');
    }

    $max_articles = $_POST['selectPagines'] ?? $_COOKIE['paginacioHome'] ?? 6;
    $ordenacio_art = $_POST['selectOrder'] ?? $_COOKIE['order_art'] ?? 'titol';

    setHomeCookies($max_articles, $ordenacio_art);
    ordenarArticles($articles, $ordenacio_art);

    $articlesMostrats = $articles ? paginationChunks($max_articles, $articles) : null;
    $paginesData = getPagesData($articlesMostrats, "home") ?? null;


    include 'view/home.vista.php';
}

function setHomeCookies($max_articles, $ordenacio_art)
{
    setcookie('paginacioHome', $max_articles);
    setcookie('order_art', $ordenacio_art);
}


function ordenarArticles(&$articles, $order)
{
    if ($articles == null) return;
    foreach ($articles as $key => $row) {
        $id[$key] = $row['id'];
        $title[$key] = strtolower($row['titol']);
        $name[$key] = strtolower($row['name']);
    }

    switch ($order) {
        case 'id':
            $order = $id;
            break;
        case 'name':
            $order = $name;
            break;
        case 'titol':
        default:
            $order = $title;
            break;
    }

    array_multisort($order, SORT_ASC, $articles);
}