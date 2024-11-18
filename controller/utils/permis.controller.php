<?php 

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'Administrador') {

    http_response_code(403);
    exit();
}
?>