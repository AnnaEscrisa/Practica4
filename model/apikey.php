<?php
// Anna Escribano Sabio
namespace Backend\Model;

use Backend\Model\Database;
use Backend\Model\Usuari;

class ApiKey extends Database
{

    private $taula;
    private $select;
    private $join;
    private $userModel;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->userModel = new Usuari();
        $this->taula = "user_apikey";
        $this->select = " user_fk, apikey, created_at, expiracio, users.isAdmin ";
        $this->join = ' LEFT JOIN users ON user_apikey.user_fk = users.id ';
    }

    function selectKeyByUserId($id)
    {
        $resultat = $this->selectSpecific($this->taula, $this->select, "user_fk", $id, $this->join);
        if ($resultat) {
            return $resultat[0];
        }
        return null;
    }

    function selectKey($key)
    {
        $resultat = $this->selectSpecific($this->taula, $this->select, "apikey", $key, $this->join);
        return $resultat ? $resultat[0] : null;
    }

    function generarKey($userId)
    {
        $usuari = $this->userModel->selectUserById($userId);
        if ($usuari == null) {
            return null;
        }
        $key = md5(uniqid(rand(), true));
        $key .= $usuari['isAdmin'] ? 'API_ADMIN' : "";
        $expiracio = date('Y-m-d H:i:s', strtotime('+365 days'));

        if ($this->selectKeyByUserId($userId) == null) {
            $this->insert($this->taula, ' user_fk, apikey, expiracio ', [$userId, $key, $expiracio], ' ?, ?, ? ');
        } else {
            $this->updateBy($this->taula, 'user_fk', $userId, [$key, $expiracio], ' apikey = ?, expiracio = ? ');
        }

        $apikey = [
            'apikey' => $key,
            'expiracio' => $expiracio
        ];
        return $apikey;
    }

    function comprovarKey($key)
    {
        $possibleKey = $this->selectKey($key);
        if ($possibleKey == NULL || strtotime($possibleKey['expiracio']) < strtotime(date('Y-m-d H:i:s'))) {
            return false;

        } else {
            return $possibleKey;
        }
    }

}