<?php
//Controla els diferents updates de les dades de l'usuari

require 'model/user.model.php';

require 'oblit.controller.php';
require 'newpass.controller.php';
require 'fitxa.controller.php';
require 'controller/utils/validacio.controller.php';
require 'controller/utils/mailer.controller.php';


$userModel = new Usuari();
$mailerController = new MailerController();

$ruta = array_slice(explode('/', $_SERVER["REQUEST_URI"]), -1)[0];
$ruta = explode('?', $ruta)[0];
$permis = "";


switch ($ruta) {
    case 'profile':
        $pageTitle = 'Perfil';
        //carregarPerfil($userModel, $permis, $missatge);
        break;

    case 'editar':
        $pageTitle = 'Editar usuari';
        //carregarEdicio($userModel, $permis, $missatge);
        break;

    case 'new_pass':
        $pageTitle = 'Canvi Contrasenya';
        carregarCanviPass($userModel, $permis, $missatge);
        processarCanviPass($userModel, $missatge);
        include 'view/newPass.vista.php';
        break;

    case 'recuperacio':
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