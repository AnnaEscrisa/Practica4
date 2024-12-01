<?php

//comprova si l'usuari te permis per canviar la contrasenya
function carregarCanviPass($userModel, &$permis, &$missatge)
{
    if (isset($_SESSION['user_id'])) {
        $permis = "permis_logat";
    } else if (comprovarTokenValid($userModel)) {
        $permis = "permis_token";
    } else {
        buildMessage(error_rec2, 'error', 'home', '');
    }
}

function processarCanviPass($userModel, &$missatge)
{

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if ($_SESSION['user_id']) {
            canviUserLogat($userModel, $missatge);
        } else {
            canviUserNoLogat($userModel, $missatge);
        }
    }
}

function canviUserLogat($userModel, &$missatge)
{
    $oldContrasenya = $_POST['oldPassword'];
    $contrasenya = $_POST['password'];
    $repeticioContrasenya = $_POST['passwordRepeat'];

    if (!$oldContrasenya || !$repeticioContrasenya || !$contrasenya) {
        $missatge = error_g1;
        return;
    }

    $user = $userModel->selectUserById($_SESSION['user_id']);
    if (!password_verify($oldContrasenya, $user['password'])) {
        $missatge = error_r6;
        return;
    }

    if (!mateixaContrasenya($contrasenya, $repeticioContrasenya)) {
        $missatge = error_r3;
    } else if (!contrasenyaSegura($contrasenya)) {
        $missatge = error_r5;
    } else {
        $valors = password_hash($contrasenya, PASSWORD_DEFAULT);

        $userModel->updateUsuari($_SESSION['user_id'], [$valors], 'password = ?');
        buildMessage(success_rec2, 'success', 'home', '');
    }
}



function canviUserNoLogat($userModel, &$missatge)
{
    $user_id = $_POST['user_id'];
    $contrasenya = $_POST['password'];
    $repeticioContrasenya = $_POST['passwordRepeat'];
    
    if (!$user_id || !$repeticioContrasenya || !$contrasenya) {
        $missatge = error_g1;
        return;
    }

    if (!mateixaContrasenya($contrasenya, $repeticioContrasenya)) {
        $missatge = error_r3;
    } else if (!contrasenyaSegura($contrasenya)) {
        $missatge = error_r5;
    } else {
        $valors = password_hash($contrasenya, PASSWORD_DEFAULT);

        $userModel->updateUsuari($user_id, [$valors], 'password = ?');
        buildMessage(success_rec2, 'success', 'home', '');
    }
}


function comprovarTokenValid($userModel)
{
    $token = $_GET['token'];
    $user_id = $_GET['id'];

    if ($userModel->comprovarCodi($token, $user_id)) {
        return true;
    }
}