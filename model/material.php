<?php
// Anna Escribano Sabio
namespace Backend\Model;

use Backend\Model\Database;

class Material extends Database {

    private $taula;
    private $select;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->taula = "ingredients";
        $this->select = " ingredients.id, ingredients.nom, ingredients.tipus ";
    }
    
    public function selectMaterials(){
        $resultat = $this->selectAllSpecific($this->taula, $this->select);
        return $resultat;
    }
}