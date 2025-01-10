<?php

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Output\QRGdImage;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\Data\QRMatrix;

//article qr
function articleQr()
{
    $fields = [
        'titol' => $_POST['titol'] ?? false,
        'descripcio' => $_POST['descripcio'] ?? false,
        'ingredients' => $_POST['ingredients'] ?? false,
        'imatge' => $_POST['imatge'] ?? false,
    ];

    $id = $_POST['id'] ?? false;
    $url = ARTICLE_URL . $id;

    foreach ($fields as $key => $value) {
        if (!$value) {
            $url .= "&{$key}=false";
        }
    }

    //crear qr
    return createQr($url);
}




//user qr?




//coven qr



//create qr (url basica)
// ficar url basica a qr
// mostrar qr al usuari (return)
function createQr($url)
{
    $options = new QROptions([
        'outputType'   => QROutputInterface::GDIMAGE_PNG
    ]);
    $options->keepAsSquare        = [
        QRMatrix::M_FINDER_DARK,
        QRMatrix::M_FINDER_DOT,
        QRMatrix::M_ALIGNMENT_DARK,
    ];
    $options->moduleValues        = [
        QRMatrix::M_FINDER_DARK    => [243, 196, 42], //amarillo
    ];
    $img = "<img data-url=$url height='300' alt='QR Code' src='". (new QRCode($options))->render($url). "' />";
    return $img;
}


//read qr