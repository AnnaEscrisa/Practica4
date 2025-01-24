<?php 

use chillerlan\QRCode\{QRCode, QROptions};

require_once 'vendor/autoload.php';

$data = 'wikipedia.net';

// quick and simple:
echo '<img height="100" src="'.(new QRCode)->render($data).'" alt="QR Code" />';