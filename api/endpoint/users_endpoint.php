<?php

namespace Backend\Api\Endpoint;

use Backend\Api\Endpoint\Api_Endpoint;
use Backend\Model\Usuari;

class Users_Endpoint extends Api_Endpoint
{
    private $userModel;
    
    public function __construct(){
        $this->userModel = new Usuari();
    }

    public function getAll()
    {
        return $this->userModel->selectUsers();
    }

    public function getById($id)
    {
        return $this->userModel->selectUserById($id);
    }

}


?>