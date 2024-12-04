<?php


function transformarRutaAccess()
{
    $ruta = array_slice(explode('/', $_SERVER["REQUEST_URI"]), -1)[0];
    switch (true) {
        case str_contains($ruta, 'Logout'):
            return 'logout';
        case str_contains($ruta, 'deviantart'):
            return 'deviantart';
        case str_contains($ruta, 'github'):
            return 'github';
        case str_contains($ruta, 'login'):
            return 'login';
        default:
            return $ruta;
    }
}

function transformarRutaProfile()
{
    $ruta = array_slice(explode('/', $_SERVER["REQUEST_URI"]), -1)[0];
    switch (true) {
        case str_contains($ruta, 'isEdit'):
            return 'editar';
        case str_contains($ruta, 'isDelete'):
            return 'eliminar';
        case str_contains($ruta, 'new_pass'):
            return 'new_pass';
        default:
            return $ruta;
    }
}

//! VIGILAR
function transformarRutaAdmin()
{
    $ruta = array_slice(explode('/', $_SERVER["REQUEST_URI"]), -1)[0];
    switch (true) {
        case str_contains($ruta, 'admin'):
            return 'admin';
        default:
            return $ruta;
    }
}


function transformarRutaArticle()
{
    $ruta = array_slice(explode('/', $_SERVER["REQUEST_URI"]), -1)[0];
    switch (true) {
        case str_contains($ruta, 'myArticles=true'):
            return 'myArticles';
        case str_contains($ruta, 'isEdit=true'):
            return 'editar';
        case str_contains($ruta, 'isDelete=true'):
            return 'eliminar';
        case str_contains($ruta, 'home'):
            return 'home';
        case str_contains($ruta, 'articles_form'):
            return 'nou';
        default:
            return $ruta;

    }
}
