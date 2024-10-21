<?php
//Anna Escribano

//------------------- Missatges d'error ------------------------
//missatges generals
$error_g1 = "Tots els camps han de ser omplerts";
$error_g2 = "Caracters màxims excedits";
$error_g3 = "Vols eliminar aquest registre? Aquesta acció és irreversible";
$error_g4 = "No es permet l'inserció de codi html o javascript";
$error_g5 = "S'ha tancat la sessió per inactivitat";
$success_g1 = "S'ha eliminat el registre amb èxit.";

//errors articles
$error_a1 = "Aquest títol ja existeix";
$error_a2 = "No s'ha pogut inserir";
$error_a3 = "No s'ha pogut modificar";
$error_a4 = "Article inexistent.";

$success_a1 = "Article inserit amb èxit";
$success_a2 = "Article modificat amb èxit";

//errors login
$error_l1 = "Usuari o contrasenya incorrectes";
$error_l2 = "No s'ha pogut iniciar sessió";

$success_l1 = "S'ha iniciat sessió amb èxit";
$success_l2 = "S'ha tancat la sessió amb èxit";

//errors register
$error_r1 = "No s'ha pogut crear l'usuari";
$error_r2 = "El nom d'usuari ja existeix";
$error_r3 = "Les contrasenyes no coincideixen";
$error_r4 = "El format de l'email no és correcte";
$error_r5 = "La contrasenya no és prou segura";

$success_r1 = "S'ha creat l'usuari amb èxit";

//errors recuperacio
$error_rec1 = 'Usuari no trobat';
$error_rec2 = "Dades incorrectes. El codi pot ser incorrecte o expirat";
$success_rec1 = 'Mail enviat amb èxit';
$success_rec2 = "Contrasenya canviada";


//-------------------Finestra d'error----------------------
//variables per recollir possibles errors
$error;
$class = "error";
$previousParams = "";

//variables per mostrar error actual
$tipus = $_GET["Tipus"] ?? false; //classe passada per url
$missatge = $_GET["Message"] ?? false; //missatge passat per url
$displayEliminar = "hidden"; //display del boto d'eliminar, ocult per defecte


//si missatge te valor, mostrarà un missatge a la pàgina actual
function showMessage($tipus, $missatge, $displayEliminar)
{
    if ($missatge) {
        
        $alerta = "<div class='alert alert-dismissible alert-$tipus' role='alert'>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Tancar'></button>
            <h4>$missatge</h4>
            <form action='' method='post' class='$displayEliminar'>
                <input class='btn btn-danger' type='submit' name='elimina' value='Eliminar'></input>
            </form>
        </div>";
        echo $alerta;
    }
}

//Carrega una pagina, adjuntant diversos parametres a la url per confeccionar un missatge d'error
function buildMessage($message, $class, $location, $parametres)
{
    header("Location:" . $location . ".php?Message=" . $message . "&Tipus=" . $class . "&" . $parametres);
    exit;
}

?>
