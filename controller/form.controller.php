<?php
// Anna Escribano

require "model/article.model.php";

$articleModel = new Article();
$pageTitle = "Nou Article";
$titol = ""; //titol actual de l'article
$cos = ""; //cos actual de l'article
$id = ""; //id actual de l'article

$ruta = "form";


//mostrem error actual si hi ha
showMessage($tipus, $missatge, $displayEliminar);


//*------------------- Carregar mode edició -----------------------

//comprovem si estem en mode edició
$isEdit = $_GET["isEdit"] ?? false;

if ($isEdit) {
    $id = $_GET["id"];
    $article = $articleModel->selectArticleById($id);

    //comprovem si l'article existeix, per si algun llest de torn canvia manualment l'id de l'article als parametres
    if (!$article) {
        $error = $error_a4;
        buildMessage($error, $class, $ruta, $previousParams);
    } else {
        //si l'article existeix, establirem el valor dels inputs
        $article = $article[0];
        $pageTitle = "Editar article - " . $article["id"];
        $titol = $article["titol"];
        $cos = $article["cos"];
    }
}

//*--------------------- Carregar mode eliminació----------------

//comprovem si estem en mode eliminació
$isDelete = $_GET["isDelete"] ?? false;

if ($isDelete) {
    $id = $_GET["id"];
    $article = $articleModel->selectArticleById($id);

    if (!$article) {
        $error = $error_a4;
        buildMessage($error, $class, $ruta, $previousParams);
    } else {

        //carreguem l'article perque l'usuari vegi quin article elimina
        $article = $article[0];
        $pageTitle = "Eliminar article - " . $article["id"];
        $titol = $article["titol"];
        $cos = $article["cos"];

        $error = $error_g3;
        $previousParams = "id=$id";
        $displayEliminar = "";

        showMessage($class, $error, $displayEliminar);
    }
}

//*--------------------Inserir/editar ---------------

//només s'executarà si s'ha enviat un formulari
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nouCos = $_POST["nouCos"] ?? false;
    $nouTitol = $_POST["nouTitol"] ?? false;
    $eliminacio = $_POST["elimina"] ?? false;

    //entrada pel formulari d'eliminació
    //eliminarà l'article i redireccionarà a Home amb un missatge
    if ($eliminacio) {
        $id = $_GET["id"];
        $articleModel->deleteArticle($id);
        $error = $success_g1;
        $class = "success";
        $ruta = "index";
        buildMessage($error, $class, $ruta, "");
    }

    //entrada pel formulari d'edicio/inserció
    if ($nouCos && $nouTitol) {

        //si estem editant
        if ($id) {
            $result = $articleModel->updateArticle($id, $nouTitol, $nouCos);

            //comprovarà l'update i retornarà un missatge depenent del resultat
            switch ($result) {
                case 4:
                    $error = $error_a1;
                    break;
                case 3:
                    $error = $error_g4;
                    break;
                case 2:
                    $error = $error_g2;
                    break;
                case 1:
                    $error = $success_a2;
                    $class = "success";
                    break;
                default:
                    $error = $error_a3;
                    break;
            }

            //si estem creant un article nou
        } else {
            $result = $articleModel->insertArticle($nouTitol, $nouCos);

            switch ($result) {
                case 4:
                    $error = $error_a1;
                    break;
                case 3:
                    $error = $error_g4;
                    break;
                case 2:
                    $error = $error_g2;
                    break;
                case 1:
                    $error = $success_a1;
                    $class = "success";
                    break;
                case 0:
                    $error = $error_a2;
                    break;
            }
        }

    } else {
        $error = $error_g1;
        $previousParams = $id? "isEdit=true&id=$id": "";
    }

    buildMessage($error, $class, $ruta, $previousParams);
}