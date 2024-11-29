<?php
// Anna Escribano

//Pròximament: mostrarà tots els usuaris per l'Admin
require 'utils/permis.controller.php';
require "model/user.model.php";
$userModel = new Usuari();

$pageTitle = "Usuaris";
$usuaris;


showMessage($tipus, $missatge, $displayEliminar);

if ($_SESSION['user'] == 'Administrador') {
    $usuaris = $userModel->selectUsers();


    //*-------- Paginacio--------

    $max_users = 5;

    $usuarisMostrats = paginationChunks($max_users, $usuaris);
    $paginesData = getPagesData($usuarisMostrats);


    include 'view/users.vista.php';
}



?>