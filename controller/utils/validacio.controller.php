<?php
//Anna Escribano

//Controller que inclou funcions per validar l'input de l'usuari.


//Parseja els possibles errors dels articles i els converteix en missatges d'error.
function parseArticleError($result, $operation)
{
    $messages = $operation === 'insert' ? [
        4 => error_g4,
        3 => error_a1,
        2 => error_g2,
        1 => success_a1,
        0 => error_a2
    ] : [
        4 => error_g4,
        3 => error_a1,
        2 => error_g2,
        1 => success_a2,
        0 => error_a3
    ];

    return getValorMessage($result, $messages);
}


//Parseja els possibles errors dels usuaris i els converteix en missatges d'error.
function parseUserError($result, $operation)
{
    $messages = $operation === 'insert' ? [
        7 => error_r3,
        6 => error_r4,
        5 => error_r5,
        4 => error_g4, 
        3 => error_r2, 
        2 => error_g2, 
        1 => success_r1, 
        0 => error_r1  
    ] : [
        4 => error_r2, 
        3 => error_r4, 
        2 => error_r5, 
        1 => success_r2,
        0 => error_r1  
    ];

    return getValorMessage($result, $messages);
}

//EN base al resultat, escollirà un missatge d'error i una classe d'error i el retornarà
function getValorMessage($result, $messages)
{
    if ($result == 1) {
        return [$messages[$result], 'success'];
    } else {
        return [$messages[$result], 'error'];
    }
}

//Comprovacions de l'input de l'usuari abans de probar les validacions del model
function getInitialUserValidation($usuari, $contrasenya, $repeticioContrasenya, $nom, $email)
{
    $dades= [$usuari, $contrasenya, $repeticioContrasenya, $nom, $email];
    if (comprovarHtmlCamps($dades)) {
        return 4;
    }

    if (!contrasenyaSegura($contrasenya)) {
        return 5;
    }

    if(comprovarEmail($email)){
        return 6;
    }

    if(!mateixaContrasenya($contrasenya, $repeticioContrasenya)) {
        return 7;
    }

    return NULL;
}

function getInitialArticleValidation($titol, $cos, $ingredients)
{
    $dades= [$titol, $cos, $ingredients];
    if (comprovarHtmlCamps($dades)) {
        return 4;
    }

    return NULL;
}

//*---------------------- Funcions de comprovacio --------

//comprova si hi ha contingut script o html
function comprovarHtml($valor)
{
    if (htmlspecialchars($valor) != $valor) {
        return true;
    }
}

function comprovarHtmlCamps($arrayDades)
{
    foreach ($arrayDades as $dada) {
        if (comprovarHtml($dada)) {
            return true;
        }
    }
}

function mateixaContrasenya($contrasenya, $altreContrasenya){
    return $contrasenya == $altreContrasenya;
}

//comprova si la contrasenya te numeros i lletres
function contrasenyaSegura($contrasenya)
{
    if (strlen($contrasenya) >= 8 && preg_match("#[0-9]+#", $contrasenya) && preg_match("#[a-z]+#", $contrasenya)) {
        return true;
    }
}

function comprovarEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
}

?>