<?php
// Anna Escribano

//Pròximament: mostrarà tots els usuaris per l'Admin


require "model/user.model.php";
$userModel = new Usuari();

$pageTitle = "Usuaris";
$usuaris;


showMessage($tipus, $missatge, $displayEliminar);
$_SESSION['userRole'] = 'Administrator';

if (isset($_SESSION['user']) && $_SESSION['userRole'] == 'Administrator') {
    $usuaris = $userModel->selectUsers();


    //*-------- Paginacio--------

    $max_users = 5;

    $usuarisMostrats = paginationChunks($max_users, $usuaris);
    $paginesData = getPagesData($usuarisMostrats);


    include 'view/users.vista.php';
}



?>