<?php

function processarLogin($userModel, &$missatge)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $usuari = $_POST["usuari"] ?? null;
        $contrasenya = $_POST["password"] ?? null;
        $recorda = $_POST["recorda"] ?? null;
        $captcha = captchaBuit($missatge);

        if ($usuari && $contrasenya && $captcha) {

            $login = $userModel->login($usuari, $contrasenya);
            if ($login) {

                setCookies($recorda, $usuari);

                guardarDadesSessio($userModel, $usuari);

                $params = "myArticles=true";
                $class = 'success';
                buildMessage(success_l1, $class, "home", $params);
            } else {
                loginFallit($missatge);
            }
        } else {
            $missatge = error_g1;
        }
    }
}


function captchaBuit(&$missatge)
{
    $recaptcha = $_POST['g-recaptcha-response'] ?? null;

    if (isset($_COOKIE['intentsLogin']) && $_COOKIE['intentsLogin'] >= 3 && !$recaptcha) {
        return false;
    }
    return true;
}

function loginFallit(&$missatge)
{
    $intentsLogin = $_COOKIE['intentsLogin'] ?? 0;
    setcookie('intentsLogin', 1 + $intentsLogin, time() + 10 * 60);
    $missatge = error_l1;
}

function guardarDadesSessio($userModel, $userName)
{
    $_SESSION["user"] = $userName;
    $user = $userModel->selectUserByUsername($userName)[0];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['admin'] = $user['isAdmin'];
    $_SESSION['social'] = $user['isSocial'];
}

function setCookies($recorda, $usuari)
{
    if ($recorda) {
        setcookie("recorda", $usuari, time() + 10 * 24 * 60 * 60);
    }
    setcookie('intentsLogin', 0);
}

function logout()
{
    $isLogout = $_GET['isLogout'] ?? null;

    if ($isLogout) {
        session_unset();
        session_destroy();
        buildMessage(success_l2, "success", "home", "");
    }
}