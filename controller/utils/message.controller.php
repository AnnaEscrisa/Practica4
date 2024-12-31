<?php
//Anna Escribano

//------------------- Missatges d'error ------------------------

//missatges generals
const error_g1 = "Tots els camps obligatoris han de ser omplerts";
const error_g2 = "Caracters màxims excedits";
const error_g3 = "Vols eliminar aquest registre? Aquesta acció és irreversible";
const error_g4 = "No es permet l'inserció de codi html o javascript";
const error_g5 = "S'ha tancat la sessió per inactivitat";
const error_g6 = "No tens permís per accedir a aquest recurs.";
const success_g1 = "S'ha eliminat el registre amb èxit.";

//errors articles
const error_a1 = "Aquest títol ja existeix";
const error_a2 = "No s'ha pogut inserir";
const error_a3 = "No s'ha pogut modificar";
const error_a4 = "Article inexistent.";
const error_a5 = "No tens permís per modificar aquest article.";

const success_a1 = "Article inserit amb èxit";
const success_a2 = "Article modificat amb èxit";

//errors login
const error_l1 = "Usuari o contrasenya incorrectes";
const error_l2 = "No s'ha pogut iniciar sessió";

const success_l1 = "S'ha iniciat sessió amb èxit";
const success_l2 = "S'ha tancat la sessió amb èxit";

//errors usuari
const error_r1 = "No s'ha pogut crear l'usuari";
const error_r2 = "El nom d'usuari ja existeix";
const error_r3 = "Les contrasenyes no coincideixen";
const error_r4 = "El format de l'email no és correcte";
const error_r5 = "La contrasenya no és prou segura";
const error_r6 = "La contrasenya antiga no es  correcta";
const error_r7 = "No s'ha pogut editar l'usuari";

const success_r1 = "S'ha creat l'usuari amb èxit";
const success_r2 = "S'ha modificat l'usuari amb èxit";
const success_r3 = "S'ha eliminar l'usuari amb èxit";

//errors recuperacio
const error_rec1 = 'Usuari no trobat';
const error_rec2 = "No pots canviar la contrasenya. El link pot ser incorrecte o expirat";

const success_rec1 = 'Mail enviat amb èxit';
const success_rec2 = "Contrasenya canviada amb éxit";

const error_i1 = "Format d'imatge no permesa. S'admeten extensions PNG, JPG, JPEG i WEBP.";
const error_i2 = "L'arxiu és massa gran. El màxim permès és de 2MB.";


//-------------------Finestra d'error----------------------
/*variables per recollir possibles errors.
Seran omplenades a mida que trobem errors als inputs de l'usuari i enviades en una redirecció*/
$error;
$class = "error";
$previousParams = "";

/*variables per mostrar últim error.
Reben el valor dels parametres de la ruta*/
$tipus = $_GET["Tipus"] ?? "error";
$missatge = $_GET["Message"] ?? '';
$displayEliminar = "hidden";


//si missatge te valor, mostrarà un missatge a la pàgina a la que ens trobem
function showMessage($tipus, $missatge, $displayEliminar)
{
    if ($missatge) {

        $alerta = "<div id='alerta_miss' class='alert alert-dismissible alert-$tipus' role='alert'>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Tancar'></button>
            <h4>$missatge</h4>
            <form action='' method='post' class='$displayEliminar'>
                <input class='btn btn-danger' type='submit' name='elimina' value='Si'></input>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Tancar'>No</button>
            </form>
        </div>
        <script src='public/js/reload.js'></script>";
        echo $alerta;
    }
}

/*Carrega una pagina, adjuntant diversos parametres a la url*/
function buildMessage($message, $class, $location, $parametres)
{
    header("Location:" . $location . "?Message=" . $message . "&Tipus=" . $class . "&" . $parametres);
    exit;
}

?>