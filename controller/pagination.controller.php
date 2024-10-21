<?php
//Anna Escribano

/* si hi ha items, els dividira en grups de la quantitat especificada a $max
i retornarà un array */
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
    $totalPages = $itemsEnChunks ? count($itemsEnChunks) : 0;

    $data = [
        'currentPage' => $currentPage,
        'nextPage' =>$nextPage,
        'previousPage' => $previousPage,
        'totalPages' => $totalPages,
        'previousClass' => $previousPage == 0 ? 'hidden' : '',//classe del boto pagina anterior
        'nextClass' => $nextPage == $totalPages + 1 ? "hidden" : '',//classe del boto pagina següent
    ];

    return $data;
}

?>