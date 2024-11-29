<?php

function carregarCanviPass($userModel, &$permis, &$missatge)
{
    if (isset($_SESSION['user_id'])) {
        $permis = "permis_logat";
        //! REPASAR ESTO, NUNCA DARA VALOR A MESSAGE
    } else if (comprovarTokenValid($missatge, $userModel)) {
        $permis = "permis_token";
    } else {
        buildMessage(error_rec2, 'error', 'home', '');
    }
}

function processarCanviPass($userModel, &$missatge){
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id = $_GET['id'];
        $contrasenya = $_POST['password'];
        $repeticioContrasenya = $_POST['passwordRepeat'];

        if ($contrasenya && $repeticioContrasenya) {

            if (!mateixaContrasenya($contrasenya, $repeticioContrasenya)) {
                $missatge = error_r3;
            } else if (!contrasenyaSegura($contrasenya)) {
                $missatge = error_r5;
            } else {

                $valors = password_hash($contrasenya, PASSWORD_DEFAULT);

                $userModel->updateUsuari($user_id, [$valors], 'password = ?');
                buildMessage(success_rec2, 'success', 'home', '');
            }
        } else {
            $missatge = error_g1;
        }
    }
}


function comprovarTokenValid(&$missatge, $userModel)
{
    $token = $_GET['token'];
    $user_id = $_GET['id'];

    if ($userModel->comprovarCodi($token, $user_id)) {
        return true;
    }
    $missatge = error_rec2;
}