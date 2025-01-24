<?php
require 'vendor/autoload.php'; // Include Composer's autoload

use nguyenary\QRCodeMonkey\QRCode as Monkey;

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

    try {
        return sendToQrMonkey($data);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    /*
    Funcionament original:

    try {
        return createQr($data);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
   */
}




//user qr?




//coven qr



//Crear QR mitjan qr monkey api
function sendToQrMonkey($data)
{
    $qrcode = new Monkey($data);

    $qrcode->setConfig([
        "body" => "star",
        "eye" => "frame14",
        "eyeBall" => "ball19",
        "bodyColor" => "#5C8B29",
        "bgColor" => "#FFFFFF",
        "eye1Color" => "#6A1195",
        "eye2Color" => "#6A1195",
        "eye3Color" => "#6A1195",
        "eyeBall1Color" => "#6A1195",
        "eyeBall2Color" => "#6A1195",
        "eyeBall3Color" => "#6A1195",
        "gradientColor1" => "#6A1195",
        "gradientColor2" => "#896B9B",
        "gradientType" => "radial",
        "gradientOnEyes" => false,
        "erf2" => ["fh"],
        "erf3" => ["fv"],
        "logo" => ""
    ]);

    $qrcode->setFileType('png');
    $qrcode->setSize(300);

    return "<img data-url=$data height='300' alt='QR Code' src='" . $qrcode->create() . "' />";
}


//Crear QR Original
// Funcional. Mitjançant llibreria chillerlean
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
