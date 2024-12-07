<?php
//Anna Escribano

session_start();

//comprovem l'ultim acces de l'usuari. Si supera el timeout establert, se'l reconduirà al login
function comprovarActivitat($timeout) {
 
    if (isset($_SESSION['lastaccess'])) {

        $duration = time() - intval($_SESSION['lastaccess']);
    
        if ($duration > $timeout) {
            session_unset();
            session_destroy();
            buildMessage(error_g5, 'error', 'login', '');
        }
    }
}

function registrarActivitat(){
    if (isset($_SESSION['user'])) {
        $_SESSION['lastaccess'] = time();
    }
}

//mantenir sessio oberta

function mantenerSessioOberta() {
    session_regenerate_id(true);
    $_SESSION['lastaccess'] = time();
}

?>