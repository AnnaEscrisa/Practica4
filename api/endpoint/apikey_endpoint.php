<?php

namespace Backend\Api\Endpoint;

use Backend\Api\Endpoint\Api_Endpoint;
use Backend\Model\ApiKey;

class ApiKey_Endpoint extends Api_Endpoint
{
    private $apikeyModel;
    
    public function __construct(){
        $this->apikeyModel = new ApiKey();
    }

    //no implementat perque no s-utilitzara mai
    public function getAll()
    {
    }

    //get by id de l-usuari, no de la key
    public function getById($id)
    {
        return $this->apikeyModel->selectKeyByUserId($id);
    }

    public function create($id)
    {
        return $this->apikeyModel->generarKey($id);
    }

}


?>