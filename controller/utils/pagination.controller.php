<?php
//Anna Escribano

/* divideix items en parts */
function paginationChunks($max, $items)
{
    return $items ? array_chunk($items, $max) : "";
}

/* basant-se en la quantitat de items i la pagina actual, estableix les 
altres pàgines i el nombre màxim d'aquestes.
Determinarà si el botó de seguent o anterior es ocult */
function getPagesData($itemsEnChunks)
{
    $currentPage = $_GET['page'] ?? 1;
    $nextPage = $currentPage + 1;
    $previousPage = $currentPage - 1;
    $totalPages = $itemsEnChunks ? count($itemsEnChunks) : 1;
    //si algu posa un numero de pagina inexistent, retorna a primera pàgina
    if($currentPage > $totalPages) {
        header('Location: home');
    }

    $data = [
        'currentPage' => $currentPage,
        'nextPage' => $nextPage,
        'previousPage' => $previousPage,
        'totalPages' => $totalPages,
        'previousClass' => $previousPage == 0 ? 'hidden' : '',//classe del boto pagina anterior
        'nextClass' => $nextPage == $totalPages + 1 ? "hidden" : '',//classe del boto pagina següent
    ];

    return $data;
}

?>