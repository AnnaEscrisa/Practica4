<?php
//Anna Escribano

session_start();

//comprovem l'ultim acces de l'usuari. Si supera el timeout establert, se'l reconduirà al login
function comprovarActivitat($timeout) {
 
    if (isset($_SESSION['lastaccess'])) {

        $duration = time() - intval($_SESSION['lastaccess']);
    
        if ($duration > $timeout) {
            //esborrem dades de sessio i redirigim a login
            session_unset();
            session_destroy();
            $ruta = 'login';
            buildMessage(error_g5, 'error', $ruta, '');
        }
    }
}

function registrarActivitat(){
    if (isset($_SESSION['user'])) {
        //enrellistrem l'ultim acces de l'usuari ara
        $_SESSION['lastaccess'] = time();
    }
}

?>