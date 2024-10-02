<?php

//------------------- Missatges d'error ------------------------
//missatges generals
$error_g1 = "Tots els camps han de ser omplerts";
$error_g2 = "Caracters màxims excedits";
$error_g3 = "Vols eliminar aquest registre? Aquesta acció és irreversible";
$success_g1 = "S'ha eliminat el registre amb èxit.";

//errors articles
$error_a1 = "Aquest títol ja existeix";
$error_a2 = "No s'ha pogut inserir";
$error_a3 = "No s'ha pogut modificar";
$error_a4 = "Article inexistent.";

//exit articles
$success_a1 = "Article inserit amb èxit";
$success_a2 = "Article modificat amb èxit";


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
