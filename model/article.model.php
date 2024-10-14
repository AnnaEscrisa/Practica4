<?php
// Anna Escribano Sabio

require 'database.model.php';
class Article extends Database
{
    private $taula;//taula corresponent a la bbdd

    //construim la classe mare al constructor per crear una connexió a la bbdd
    public function __construct()
    {
        parent::__construct();
        $this->taula = "articles1";
    }

    //Selecciona tots els articles
    function selectArticles()
    {
        $resultat = $this->selectAll($this->taula);
        return $resultat;
    }

    //Selecciona per id
    function selectArticleById($id)
    {
        $resultat = $this->selectBy($this->taula, "id", $id);
        return $resultat;
    }

    //Selecciona per usuari
    function selectArticleByUser($id)
    {
        $resultat = $this->selectBy($this->taula, "user_id", $id);
        return $resultat;
    }

    /* Inserta un nou registre a la taula articles
    comprova si el titol ja existeix a la bbdd i si es correcte, i si no, insereix un nou article
    Retorna:
        4 -> el titol ja existeix 
        3 -> el titol o el cos tenen codi html/js
        2 -> el titol o el cos te massa caracters
        1 -> el registre s'ha insertat correctament
        0 -> error en l'inserció
    */
    function insertArticle($titol, $cos)
    {
        $existeix = $this->comprovarExistent($this->taula, "titol", $titol);

        if ($existeix) {
            return 4;
        }
        if (
            $this->comprovarHtml($titol) ||
            $this->comprovarHtml($cos)
        ) {
            return 3;
        }
        if (
            $this->comprovarCaractersMaxims(40, $titol) ||
            $this->comprovarCaractersMaxims(400, $cos)
        ) {
            return 2;
        }
        return $this->insert($this->taula, "titol, cos", [$titol, $cos], "?, ?") ? 1 : 0;
    }

    //Modifica un article. Retorna els mateixos valors amb les mateixes condicions que la funcio d'inserir
    //Comprova si estem canviant el titol, i si es així, comprova si ja existeix
    function updateArticle($id, $titol, $cos)
    {
        $article = $this->selectArticleById($id);
        $titolActual = $article[0]['titol'];

        if ($titolActual != $titol && $this->comprovarExistent($this->taula, "titol", $titol)) {
            return 4;
        }
        if (
            $this->comprovarHtml($titol) ||
            $this->comprovarHtml($cos)
        ) {
            return 3;
        }
        if (
            $this->comprovarCaractersMaxims(40, $titol) ||
            $this->comprovarCaractersMaxims(400, $cos)
        ) {
            return 2;
        }

        $reassignacions = "titol = ?, cos = ?";
        return $this->update($this->taula, $id, [$titol, $cos], $reassignacions) ? 1 : 0;
    }

    //eleimina article 
    function deleteArticle($id)
    {
        $this->delete($this->taula, $id);
    }
}
