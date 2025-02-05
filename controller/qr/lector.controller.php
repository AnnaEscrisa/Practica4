<?php

use chillerlan\QRCode\{QRCode, QROptions};

function readQr($missatge)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $code = $_FILES['imatge'] ?? null;

        $standardqr = changeQrColor($code);

        try {
            $result = (new QRCode)->readFromFile($standardqr);
        } catch (\Throwable $th) {

            $result = $th->getMessage();
        }

        unlink($standardqr);

        $content = (string) $result;
        header("Location: $content");
        exit;
    }
}


function changeQrColor($qr)
{
    $tmpPath = $qr['tmp_name'];

    $im = imagecreatefrompng($tmpPath);
    $black = imagecolorallocate($im, 0, 0, 0);
    $w = imagesx($im);
    $h = imagesy($im);

    for ($x = 0; $x < $w; $x++) {
        for ($y = 0; $y < $h; $y++) {
            $rgb = imagecolorat($im, $x, $y);

            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            if ($r !== 255 && $g !== 255 && $b !== 255) {
    
                imagesetpixel($im, $x, $y, $black);
            }
        }
    }
    $tempFile = tempnam(sys_get_temp_dir(), 'qr_') . '.png';
    imagepng($im, $tempFile);

    imagedestroy($im);

    return $tempFile;
   
}