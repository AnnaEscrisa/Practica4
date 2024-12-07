<?php
// Anna Escribano Sabio

require_once 'database.model.php';
class Article extends Database
{
    private $taula;//taula corresponent a la bbdd
    private $select;
    private $join;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->taula = "articles";
        $this->select = " articles.id, articles.cos, articles.titol, articles.ingredients, articles.image, users.name, users.id as user_id ";
        $this->join = ' LEFT JOIN users ON articles.user_id = users.id ';

    }

    //Selecciona tots els articles i la info de l'usuari creador
    function selectArticles()
    {
        $resultat = $this->selectAllSpecific($this->taula, $this->select, $this->join);
        return $resultat;
    }

    //Selecciona per id
    function selectArticleById($id)
    {
        $resultat = $this->selectSpecific($this->taula, $this->select, "articles.id", $id, $this->join);
        return $resultat;
    }

    //Selecciona per usuari
    function selectArticleByUser($id)
    {
        $resultat = $this->selectSpecific($this->taula, $this->select, "user_id", $id, $this->join);
        return $resultat;
    }

    function selectArticleByName($name)
    {
        $resultat = $this->selectSpecific($this->taula, $this->select, "articles.titol", $name, $this->join);
        return $resultat;
    }

    /* Inserta un nou registre a la taula articles
        Comprova si el titol existeix i si les dades tenen mes caracters dels permessos.
        Retorna codis que seran llegits per validacio.controller
    */
    function insertArticle($titol, $cos, $user_id, $ingredients)
    {
        $existeix = $this->comprovarExistent($this->taula, "titol", $titol);

        if ($existeix) {
            return 3;
        }
        if (
            $this->comprovarCaractersMaxims(40, $titol) ||
            $this->comprovarCaractersMaxims(400, $cos) ||
            $this->comprovarCaractersMaxims(400, $ingredients) 
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

        if ($titolActual != $titol && $this->comprovarExistent($this->taula, "titol", $titol)) {
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

    //Modifica el user_id d'un article a 0 (anonim)
    function setArticleAnonimous($user_id) {
        $this->updateBy($this->taula, "user_id", $user_id, [0], "user_id =?");
    }

    //eleimina article 
    function deleteArticle($id)
    {
        $this->delete($this->taula, $id);
    }
}
