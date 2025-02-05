<?php
//Controla els diferents updates de les dades de l'usuari

use Backend\Model\Usuari;
use Backend\Model\Article;

require 'fitxa.controller.php';
require 'controller/utils/validacio.controller.php';
require 'controller/utils/rutes.controller.php';

$userModel = new Usuari();


$ruta = transformarRutaProfile();
$permis = "";


switch ($ruta) {
    case 'profile':
        $pageTitle = 'Perfil';
        $user = carregarUser($userModel);
        include 'view/profile.vista.php';
        break;

    case 'editar':
        $pageTitle = 'Editar usuari';
        $user = carregarUser($userModel);
        processarEdicioUser($userModel, $missatge, $tipus);
        include 'view/edicioUser.vista.php';
        break;

    case 'eliminar':;

        $articleModel = new Article();
        eliminarUser($userModel, $articleModel);
        break;

    case 'new_pass':
        require 'newpass.controller.php';

        $pageTitle = 'Canvi Contrasenya';
        carregarCanviPass($userModel, $permis, $missatge);
        processarCanviPass($userModel, $missatge);
        include 'view/newPass.vista.php';
        break;

    case 'recuperacio':
        require 'oblit.controller.php';
        require 'controller/utils/mailer.controller.php';
        $mailerController = new MailerController();

        $pageTitle = 'Recuperació';
        recuperacio($userModel, $mailerController, $missatge, $tipus);
        include 'view/recupera.vista.php';
        break;
}


//presentar ficha usuari
//utilitzar id de sessio


//canviar ficha usuari
//mateixes dades que registre, pero no pass


//canviar pass dintre de sessio





//canviar pass oblidada






// if ($_SERVER['REQUEST_METHOD'] == "POST") {

//     $contrasenya = $_POST['password'];
//     $repeticioContrasenya = $_POST['passwordRepeat'];
//     $oldContrasenya = $_POST['old_password'];
//     $isUpdate = $_GET['isUpdate'] ?? '';

//     if ($isUpdate) {

//     }

//     //si rebem tot el necessari del form
//     if ($contrasenya && $repeticioContrasenya) {

//         //validem les contrasenyes
//         if (!mateixaContrasenya($contrasenya, $repeticioContrasenya)) {
//             $error = $error_r3;
//         } else if (!contrasenyaSegura($contrasenya)) {
//             $error = $error_r5;
//         } else {

//             $valors = password_hash($contrasenya, PASSWORD_DEFAULT);

//             $userModel->updateUsuari($user_id, [$valors], 'password = ?');
//             buildMessage(success_rec2, 'success', 'home', '');
//         }
//     } else {
//         //si no ha introduit dades
//         $error = error_g1;

//     }
//     buildMessage($error, $classe, $ruta, $previousParams);
// }