<?php

function carregarUser($userModel)
{
    $id = $_GET['id'] ?? $_SESSION['user_id'];
    comprovarPermis($id);

    $user = $userModel->selectUserById($id);
    if (!$user) {
        buildMessage(error_rec1, 'error', 'home', '');
    }
    return $user;
}


function processarEdicioUser($userModel, &$missatge, &$tipus)
{
    // if post request sent
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';
        $nouUser = $_POST['usuari'] ?? '';
        $nouEmail = $_POST['email'] ?? '';
        $nouNom = $_POST['nom'] ?? '';

        $result = validacioDades($userModel, 'edit',  $nouUser, $nouNom, $nouEmail, id: $id);

        $dadesmissatge = parseUserError($result, "edit");
        $missatge = $dadesmissatge[0];
        $tipus = $dadesmissatge[1];

        
        if ($tipus == "success") {
            if (!$_SESSION['admin']) $_SESSION['user'] = $nouUser;
            buildMessage($missatge, $tipus, $_SESSION['admin'] ? 'admin' : "home", "");
        }

    }
}

function eliminarUser($userModel, $articleModel)
{
    $id = $_GET['id'];
    comprovarPermis($id);
    $user = $userModel->selectUserById($id);
    if (!$user) {
        buildMessage(error_rec1, 'error', 'home', '');
    }
    //comprovar si te articles, si te posar en anonim
    $articles = $articleModel->selectArticleByUser($id);
    if ($articles) {
        $articleModel->setArticleAnonimous($id);
    }

    $userModel->deleteUsuari($id);
    buildMessage(success_r3, 'success', 'admin', '');
}

function comprovarPermis($id)
{
    if (!isset($_SESSION['user_id']) || ($_SESSION['user_id'] != $id && !$_SESSION['admin'])) {
        buildMessage(error_g6, 'error', 'home', '');
    }
}