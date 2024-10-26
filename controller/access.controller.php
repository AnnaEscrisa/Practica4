<?php
//Anna Escribano

//Controla el login, logout, registre


require "model/user.model.php";
$userModel = new Usuari();
//treiem la ruta i pageTitle del nom d'aquest mateix arxiu
$ruta = basename($_SERVER["SCRIPT_FILENAME"], '.php');
$pageTitle = $ruta;


//mostrem error actual si hi ha
showMessage($tipus, $missatge, $displayEliminar);

//*------------- LOGOUT ---------

$isLogout = $_GET['isLogout'] ?? null;

//si cliquem a "logout", tancara la sessió i redireccionarà amb missatge
if ($isLogout) {
    session_destroy();
    $error = $success_l2;
    $class = "success";
    buildMessage($error, $class, "index", $previousParams);
}


//*------------- LOGIN / REGISTRE ---------

$usuari = $_POST["usuari"] ?? null;
$contrasenya = $_POST["password"] ?? null;
$repeticioContrasenya = $_POST["passwordRepeat"] ?? null;
$nom = $_POST["nom"] ?? null;
$email = $_POST["email"] ?? null;
$recorda = $_POST["recorda"] ?? null;
$loginSubmit = $_POST["loginSubmit"] ?? null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //entrada per registre
    if ($usuari && $contrasenya && $repeticioContrasenya && $nom && $email) {

        //validacio inicial al controlador
        $result = getInitialUserValidation($usuari, $contrasenya, $repeticioContrasenya, $nom, $email);
        if (!$result) {
            //Validacio al model
            $result = $userModel->insertUsuari($usuari, $contrasenya, $nom, $email);
        }

        $dadesmissatge = parseUserError($result, "insert");
        $error = $dadesmissatge[0];
        $class = $dadesmissatge[1];
        $ruta = $class == "success" ? "index" : "registre";

        buildMessage($error, $class, $ruta, $previousParams);
    }

    // entrada per login
    //utilitzem loginSubmit per assegurar que esta intentant entrar pel form de login, i no el de registre
    if ($usuari && $contrasenya && $loginSubmit) {

        if ($recorda) {
            setcookie("recorda", $usuari, time() + 10 * 24 * 60 * 60);
        }

        $login = $userModel->login($usuari, $contrasenya);
        if ($login) {
            $_SESSION["user"] = $usuari;
            $user = $userModel->selectUserByUsername($usuari)[0];
            $_SESSION['user_id'] = $user['id'];

            $error = $success_l1;
            $params = "myArticles=true";
            $class = 'success';
            buildMessage($error, $class, "index", $params);
        } else {
            $error = $error_l1;
            buildMessage($error, $class, $ruta, $previousParams);
        }
    }
   //submit sense inputs
    $error = $error_g1;
    buildMessage($error, $class, $ruta, $previousParams);

}
//la vista canvia depenent de la ruta original (login/registre)
include "view/$ruta.vista.php";

?>