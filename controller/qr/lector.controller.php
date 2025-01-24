<?php

use chillerlan\QRCode\{QRCode, QROptions};

function readQr($missatge)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $code = $_FILES['imatge'] ?? null;


        //obtain tmp file

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
    $w = imagesx($im); // image width
    $h = imagesy($im); // image height

    $targetR = 243;
    $targetG = 196;
    $targetB = 42;

    for ($x = 0; $x < $w; $x++) {
        for ($y = 0; $y < $h; $y++) {
            // Get the colour of this pixel
            $rgb = imagecolorat($im, $x, $y);

            // Extract the red, green, and blue components
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            // Check if the pixel matches the target color
            if ($r === $targetR && $g === $targetG && $b === $targetB) {
                // Change this pixel to black
                imagesetpixel($im, $x, $y, $black);
            }
        }
    }

    // Save the result
    $tempFile = tempnam(sys_get_temp_dir(), 'qr_') . '.png';
    imagepng($im, $tempFile);

    // Free the image resource
    imagedestroy($im);

    return $tempFile;
   
}