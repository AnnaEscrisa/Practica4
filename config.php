<?php 
define('ENVIRONMENT', 'dev');

define('BASE_URL', '');

define('DB_SERVER', 'bbdd.annaescribano.cat');
define('DB_USER', 'ddb238991');
define('DB_PASS', 'IPXi@g)lUrDFi4');
define('DB_NAME', "ddb238991");

if(ENVIRONMENT == 'dev'){
    define('GITHUB_ID', 'Ov23liuvq0ONjCjFACZu');
    define('GITHUB_SECRET','2f6b30072107ccb7cf2e0c81059e4e8f201e7fa1');
    define('CALLBACK', 'http://localhost/Xavi/practica2_1/login?github=true');
} else {
    define('CALLBACK', 'http://annaescribano.cat/backend/social_auth');
}

define('CAPTCHA_KEY', "6LfcyHAqAAAAAPp_FxgyRsNzdvfAqkmYdpWMYtKx");

define('SESSION_TIMEOUT', 40 * 60);
ini_set("session.gc_maxlifetime", SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", SESSION_TIMEOUT);

?>