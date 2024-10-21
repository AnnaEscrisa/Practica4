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
        $this->taula = "articles";
    }

    //Selecciona tots els articles i la info de l'usuari creador
    function selectArticles()
    {
        $join = ' LEFT JOIN users ON articles.user_id = users.id ';
        $resultat = $this->selectAll($this->taula, $join);
        return $resultat;
    }

    //Selecciona per id
    function selectArticleById($id)
    {
        $join = ' LEFT JOIN users ON articles.user_id = users.id ';
        $resultat = $this->selectBy($this->taula, "id", $id, $join);
        return $resultat;
    }

    //Selecciona per usuari
    function selectArticleByUser($id)
    {
        $join = ' LEFT JOIN users ON articles.user_id = users.id ';
        $resultat = $this->selectBy($this->taula, "user_id", $id, $join);
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
    function insertArticle($titol, $cos, $user_id, $ingredients)
    {
        $existeix = $this->comprovarExistent($this->taula, "titol", $titol);

        if ($existeix) {
            return 4;
        }
        if (
            $this->comprovarHtml($titol) ||
            $this->comprovarHtml($cos) ||
            $this->comprovarHtml($ingredients)
        ) {
            return 3;
        }
        if (
            $this->comprovarCaractersMaxims(40, $titol) ||
            $this->comprovarCaractersMaxims(400, $cos) ||
            $this->comprovarCaractersMaxims(400, $ingredients)  // Afegir mida per ingredients a la bbdd
        ) {
            return 2;
        }
        return $this->insert($this->taula, "titol, cos, user_id, ingredients", [$titol, $cos, $user_id, $ingredients], "?, ?, ?, ?") ? 1 : 0;
    }

    //Modifica un article. Retorna els mateixos valors amb les mateixes condicions que la funcio d'inserir
    //Comprova si estem canviant el titol, i si es així, comprova si ja existeix
    function updateArticle($id, $titol, $cos, $ingredients)
    {
        $article = $this->selectArticleById($id);
        $titolActual = $article[0]['titol'];

        //TODO canviar per que sigui error 3
        if ($titolActual != $titol && $this->comprovarExistent($this->taula, "titol", $titol)) {
            return 4;
        }

        //TODO aixo fora
        if (
            $this->comprovarHtml($titol) ||
            $this->comprovarHtml($cos) ||
            $this->comprovarHtml($ingredients)  
        ) {
            return 3;
        }

        if (
            $this->comprovarCaractersMaxims(40, $titol) ||
            $this->comprovarCaractersMaxims(400, $cos) ||
            $this->comprovarCaractersMaxims(500, $ingredients) 
        ) {
            return 2;
        }

        $reassignacions = "titol = ?, cos = ?, ingredients = ?";
        return $this->update($this->taula, $id, [$titol, $cos, $ingredients], $reassignacions) ? 1 : 0;
    }

    //eleimina article 
    function deleteArticle($id)
    {
        $this->delete($this->taula, $id);
    }
}
