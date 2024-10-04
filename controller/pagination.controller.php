<?php

// si hi ha items, els dividira en grups de la quantitat especificada a $max
// i retornarà un array 
function paginationChunks($max, $items)
{
    return $items ? array_chunk($items, $max) : "";
}

$max_articles = 5;
$articlesMostrats = paginationChunks($max_articles, $articles);

$currentPage = $_GET['page'] ?? 1;
$nextPage = $currentPage + 1;
$previousPage = $currentPage - 1;
$totalPages = $articlesMostrats ? count($articlesMostrats) : 0;
$previousClass = $previousPage == 0 ? 'hidden' : '';
$nextClass = $nextPage == $totalPages + 1 ? "hidden" : '';

?>