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
    $data = ARTICLE_URL . $id;

    foreach ($fields as $key => $value) {
        if (!$value) {
            $data .= "&{$key}=false";
        }
    }
    $url = "https://api.qr-code-monkey.com/qr/custom";
    $payload = [
        "data" => $data,
        "config" => [
            "body" => "rounded-pointed",
            "eye" => "frame14",
            "eyeBall" => "ball16",
            "bodyColor" => "#5C8B29",
            "bgColor" => "#FFFFFF",
            "eye1Color" => "#3F6B2B",
            "eye2Color" => "#3F6B2B",
            "eye3Color" => "#3F6B2B",
            "eyeBall1Color" => "#60A541",
            "eyeBall2Color" => "#60A541",
            "eyeBall3Color" => "#60A541",
            "gradientColor1" => "#5C8B29",
            "gradientColor2" => "#25492F",
            "gradientType" => "radial",
            "gradientOnEyes" => false,
            "logo" => ""
        ],
        "size" => 300,
        "download" => false,
        "file" => "png"
    ];

    try {
        return sendToQrMonkey($url, $payload);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    //crear qr
   // return createQr($url);
}




//user qr?




//coven qr



//create qr (url basica)
// ficar url basica a qr
// mostrar qr al usuari (return)
function createQr($url)
{
    $options = new QROptions([
        'outputType' => QROutputInterface::GDIMAGE_PNG
    ]);
    $options->keepAsSquare = [
        QRMatrix::M_FINDER_DARK,
        QRMatrix::M_FINDER_DOT,
        QRMatrix::M_ALIGNMENT_DARK,
    ];
    $options->moduleValues = [
        QRMatrix::M_FINDER_DARK => [243, 196, 42], //amarillo
    ];
    $img = "<img data-url=$url height='300' alt='QR Code' src='" . (new QRCode($options))->render($url) . "' />";
    return $img;
}


//read qr