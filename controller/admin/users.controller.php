<?php
function carregarUsuaris($userModel)
{
    $usuaris = $userModel->selectUsers();

    $max_users = $_POST['selectPagines'] ?? $_COOKIE['paginacioUsers'] ?? 5;
    setcookie('paginacioUsers', $max_users);

    $usuarisMostrats = paginationChunks($max_users, $usuaris);
    $paginesData = getPagesData($usuarisMostrats, "users");

    return [
        'usuarisMostrats' => $usuarisMostrats,
        'paginesData' => $paginesData,
        'maxUsers' => $max_users
    ];
}

?>