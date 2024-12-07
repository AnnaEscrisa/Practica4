<?php 

function comprovarPermisAdmin() {

    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {

        http_response_code(403);
        exit();
    }
}


?>