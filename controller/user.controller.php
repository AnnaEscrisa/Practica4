<?php

$ruta = "login.php";
$isLogout = $_GET['isLogout'] ?? null;

//si cliquem a "logout", tancara la sessió i redireccionarà amb missatge
if ($isLogout) {
    session_destroy();
    $error = $success_l2;
    buildMessage($error, $class, "index", $previousParams);
}

$usuari = $_POST["usuari"] ?? null;
$contrasenya = $_POST["password"] ?? null;
$repeticioContrasenya = $_POST["passwordRepeat"] ?? null;
$nom = $_POST["nom"] ?? null;
$email = $_POST["email"] ?? null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //entrada per registre
    if ($usuari && $contrasenya && $repeticioContrasenya && $nom && $email) {
        $result = $userModel->insertUsuari($usuari, $contrasenya, $repeticioContrasenya, $nom, $email);
        $dadesmissatge = validaDades("user", $result, "insert");
        $error = $dadesmissatge[0];
        $class = $dadesmissatge[1];
        $ruta = $class == "success" ? "index" : "registre";

        buildMessage($error, $class, $ruta, $previousParams);
    }

    //!ALERTA si fem aixo, podriem logarnos pel form de registre
    // entrada per login
    if ($usuari && $contrasenya) {

        if ($userModel->login($usuari, $contrasenya)) {
            session_start();
            $_SESSION["user"] = $user;
            $error = $success_l1;
            $params = "myArticles=true";
            buildMessage($error, $class, "index", $params);
        } else {
            $error = $error_l1;
            buildMessage($error, $class, $ruta, $previousParams);
        }
    }

    $error = $error_g1;
    $ruta = basename(__FILE__, '.php'); 
    buildMessage($error, $class, $ruta, $previousParams);

}
