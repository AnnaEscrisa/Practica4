<?php


function processarImatge(&$message)
{
    $novaImatge = $_FILES["imatge"] ?? false;
    if (!empty($novaImatge['name'])) {
        $file_ext = strtolower(pathinfo($novaImatge['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];

        if (!in_array($file_ext, $allowed_extensions)) {
            $message = error_i1;
            return false;
        }

        if ($novaImatge['size'] > 2000000) {
            $message = error_i2;
            return false;
        }
        return $novaImatge;
    }
    return false;
}

function uploadImatge($id, $imatge, $type){
    $file_ext = strtolower(pathinfo($imatge['name'], PATHINFO_EXTENSION));
    $new_file_name = $id . '.' . $file_ext;
    $path = IMG_PATH;
    if ($type == 'user') {
        $path .= 'users/';
    } else if ($type == 'article') {
        $path .= 'articles/';
    }
    $destination = $path . $new_file_name;
    move_uploaded_file($imatge['tmp_name'], $destination);
    return $new_file_name;
}

?>