<?php 

define('BASE_URL', '');

define('DB_SERVER', 'mysql-8001.dinaserver.com');
define('DB_USER', 'p2_admin');
define('DB_PASS', openssl_decrypt("RzsBvtK4pNqPQp2jAY/WEw==","AES-128-ECB","password"));
define('DB_NAME', "Pt02_Ana_Escribano");

define('CAPTCHA_KEY', "6LfcyHAqAAAAAPp_FxgyRsNzdvfAqkmYdpWMYtKx");

define('SESSION_TIMEOUT', 40 * 60);
ini_set("session.gc_maxlifetime", SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", SESSION_TIMEOUT);

?>