<?php

function setHomeCookies($max_articles, $ordenacio_art)
{
    setcookie('paginacioHome', $max_articles);
    setcookie('order_art', $ordenacio_art);
}


function ordenarArticles(&$articles, $order)
{
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