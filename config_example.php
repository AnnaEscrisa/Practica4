<?php 
define('ENVIRONMENT', 'dev');

define('BASE_URL', '');

define('DB_SERVER', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', "");

if(ENVIRONMENT == 'dev'){
    define('GITHUB_ID', '');
    define('GITHUB_SECRET','');
    define('CALLBACK', '');
} else {
    define('CALLBACK', '');
}

define('CAPTCHA_KEY', '');

define('SESSION_TIMEOUT', '');
ini_set("session.gc_maxlifetime", SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", SESSION_TIMEOUT);

?>