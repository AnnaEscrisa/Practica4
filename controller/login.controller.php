<?php

$isLogout = $_GET['isLogout']?? null;

//si cliquem a "logout", tancara la sessió i redireccionarà amb missatge
if ($isLogout) {
    //!ALERTA comporvar si cal crear la sessio tota l'estona
    //session_start();
    session_destroy();
    $error = $success_l2;
    buildMessage($error, $class, "index.php", $previousParams);
}

$usuari = $_POST["usuari"] ?? null;
$contrasenya = $_POST["password"] ?? null;

