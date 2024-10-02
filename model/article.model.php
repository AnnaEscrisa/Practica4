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

    /* Inserta un nou registre a la taula articles
    comprova si el titol ja existeix a la bbdd i si es correcte, i si no, insereix un nou article
    Retorna:
        3 -> el titol ja existeix
        2 -> el titol o el cos te massa caracters
        1 -> el registre s'ha insertat correctament
        0 -> error en l'inserció
    */
    function insertArticle($titol, $cos)
    {
        $existeix = $this->comprovarExistent($this->taula, "titol", $titol);

        if ($existeix) {
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

    //! ALERTA comprovar a la bbdd si titol es unique
    //Modifica un article. Retorna els mateixos valors amb les mateixes condicions que la funcio d'inserir
    function updateArticle($id, $titol, $cos)
    {
        $article = $this->selectArticleById($id);
        if ($article[0]["titol"] != $titol) {
            $existeix = $this->comprovarExistent($this->taula, "titol", $titol);
            if ($existeix) {
                return 3;
            }
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
    function deleteArticle($id) {
        $this->delete($this->taula, $id);
    }
}
