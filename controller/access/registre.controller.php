<?php

function processarRegistre($userModel, &$tipus, &$missatge)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $usuari = $_POST["usuari"] ?? null;
        $contrasenya = $_POST["password"] ?? null;
        $repeticioContrasenya = $_POST["passwordRepeat"] ?? null;
        $nom = $_POST["nom"] ?? null;
        $email = $_POST["email"] ?? null;

        if ($usuari && $contrasenya && $repeticioContrasenya && $nom && $email) {

            $result = validacioDades($userModel, $usuari, $repeticioContrasenya, $contrasenya, $nom, $email);

            $dadesmissatge = parseUserError($result, "insert");
            $missatge = $dadesmissatge[0];
            $tipus = $dadesmissatge[1];

            if ($tipus == "success") {
                buildMessage($missatge, $tipus, "home", "");
            }

        } else {
            $missatge = error_g1;
        }
    }

}

function validacioDades($userModel, $usuari, $repeticioContrasenya, $contrasenya, $nom, $email)
{
    //validacio inicial al controlador
    $result = getInitialUserValidation($usuari, $contrasenya, $repeticioContrasenya, $nom, $email);
    if (!$result) {
        //Validacio al model
        $result = $userModel->insertUsuari($usuari, $contrasenya, $nom, $email);
    }
    return $result;
}

?>