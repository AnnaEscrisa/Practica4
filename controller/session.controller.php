<?php
//Anna Escribano

$timeout = 40 * 60; //duracio de 40 min
ini_set("session.gc_maxlifetime", $timeout); //canvi al ini de php que no te absolutament cap efecte
ini_set("session.cookie_lifetime", $timeout);

session_start();

//comprovem l'ultim acces de l'usuari. Si supera el timeout establert, se'l reconduirà al login
if (isset($_SESSION['lastaccess'])) {

    $duration = time() - intval($_SESSION['lastaccess']);

    if ($duration > $timeout) {

        session_unset();
        session_destroy();
        $ruta = 'login';
        $error = $error_g5;
        buildMessage($error, $class, $ruta, $previousParams);
    }

}

if (isset($_SESSION['user'])) {
    //enrellistrem l'ultim acces de l'usuari
    $_SESSION['lastaccess'] = time();
}




?>