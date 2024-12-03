<?php

function carregarUser($userModel)
{
    $id = $_SESSION['user_id'];
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

        if ($nouUser && $nouNom && $nouEmail) {

            $result = validacioDades($userModel, 'edit', $id, $nouUser, $nouNom, $nouEmail);

            $dadesmissatge = parseUserError($result, "edit");
            $missatge = $dadesmissatge[0];
            $tipus = $dadesmissatge[1];

            if ($tipus == "success") {
                buildMessage($missatge, $tipus, $_SESSION['admin'] ? 'admin' : "home", "");
            }
        } else {
            $missatge = error_g1;
        }
    }
}

function eliminarUser($userModel) {
    $id = $_GET['id'];
    comprovarPermis($id);
    $user = $userModel->selectUserById($id);
    if (!$user) {
        buildMessage(error_rec1, 'error', 'home', '');
    }
    $userModel->deleteUser($id);
}

function comprovarPermis($id)
{
    if (!isset($_SESSION['user_id']) || ($_SESSION['user_id'] != $id && !$_SESSION['admin'])) {
        buildMessage(error_g6, 'error', 'home', '');
    }
}