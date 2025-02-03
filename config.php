<?php 
define('ENVIRONMENT', 'dev');

define('BASE_URL', 'http://'. $_SERVER['HTTP_HOST']. dirname($_SERVER['SCRIPT_NAME']) . '/');
define('IMG_PATH', 'public/img/');

//BBDD

define('DB_SERVER', 'bbdd.annaescribano.cat');
define('DB_USER', 'ddb238991');
define('DB_PASS', 'IPXi@g)lUrDFi4');
define('DB_NAME', "ddb238991");

// QR URL
define('ARTICLE_URL', "articles_form?isClone=true&id=");


//API
define('API_ENDPOINT', BASE_URL. "api/");
define ('API', [
    "articles" => 'articles',
    "article" => 'articles/{id}',
    "users" => 'users',
    "user" => 'users/{id}'
]);


//API KEYS

if(ENVIRONMENT == 'dev'){
    define('GITHUB_ID', 'Ov23liuvq0ONjCjFACZu');
    define('GITHUB_SECRET','2f6b30072107ccb7cf2e0c81059e4e8f201e7fa1');
    define('CALLBACK', BASE_URL . 'login?github=true');
    define('DEVIANT_CALLBACK', BASE_URL . 'login?deviantart=true');

} else {
    define('GITHUB_ID', 'Ov23liIJrpyrzzkGvrTy');
    define('GITHUB_SECRET','1cee8af6c2e0f02bacdbbb3fd2842a669b44d883');
    define('CALLBACK', 'http://www.annaescribano.cat/backend/login?github=true');
    define('DEVIANT_CALLBACK', 'http://www.annaescribano.cat/backend/login?deviantart=true');
}

define ('DEVIANTART_ID', '44074');
define('DEVIANTART_SECRET', 'a6dcca6b6a458b95081ec8b2c5c2d858');

define('CAPTCHA_KEY', "6LfcyHAqAAAAAPp_FxgyRsNzdvfAqkmYdpWMYtKx");


//SESSION

define('SESSION_TIMEOUT', 45 * 60);
ini_set("session.gc_maxlifetime", SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", SESSION_TIMEOUT);

?>