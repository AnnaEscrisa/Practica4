<?php 
define('ENVIRONMENT', 'dev');

define('BASE_URL', '');

//BBDD

define('DB_SERVER', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', "");

//API KEYS

if(ENVIRONMENT == 'dev'){
    define('GITHUB_ID', '');
    define('GITHUB_SECRET','');
    define('CALLBACK', '');
    define('DEVIANT_CALLBACK', '');

} else {
    define('GITHUB_ID', '');
    define('GITHUB_SECRET','');
    define('CALLBACK', '');
    define('DEVIANT_CALLBACK', '');
}

define ('DEVIANTART_ID', '');
define('DEVIANTART_SECRET', '');

define('CAPTCHA_KEY', "");


//SESSION

define('SESSION_TIMEOUT', 45 * 60);
ini_set("session.gc_maxlifetime", SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", SESSION_TIMEOUT);

?>