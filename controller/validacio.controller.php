<?php
//Anna Escribano

function validaDades($model, $result, $operation) {
   
    switch ($model) {
        case 'article':
            return getArticleError($result, $operation);
        case 'user':
            return getArticleError($result, $operation);
        
    }
}

//! comprovar que els missatges estan be
function getArticleError($result, $operation) {
    global $error_a1, $error_a2, $error_a3, $error_g2, $error_g4, $success_a1, $success_a2;

    $messages = $operation === 'insert' ? [
        4 => $error_a1, 
        3 => $error_g4, 
        2 => $error_g2,
        1 => $success_a1, 
        0 => $error_a2  
    ] : [
        4 => $error_a1,
        3 => $error_g4, 
        2 => $error_g2, 
        1 => $success_a2,
        0 => $error_a3 
    ];

    return getValorMessage($result, $messages);
}


//! ALERTA agafar errors de user
function getUserError($result, $operation) {
    global $error_r2, $error_r4, $error_r5, $success_r1;

    $messages = $operation === 'insert' ? [
        4 => $error_r2, // Username exists
        3 => $error_r4, // Invalid email
        2 => $error_r5, // Weak password
        1 => $success_r1, // Insert successful
        0 => $error_r1  // Insert failed
    ] : [
        4 => $error_r2, // Username exists
        3 => $error_r4, // Invalid email
        2 => $error_r5, // Weak password
        1 => $success_r2, // Update successful
        0 => $error_r1  // Update failed
    ];

    return getValorMessage($result, $messages);
}

//EN base al resultat, escollirà un missatge d'error i una classe d'error i el retornarà
//! mirar si posar millor en controlador tipus=result[1]?? $classe;
function getValorMessage($result, $messages) {
    if ($result == 1) {
        return [$messages[$result], 'success'];
    } else {
        return [$messages[$result] , 'error'];
    }
}

?>