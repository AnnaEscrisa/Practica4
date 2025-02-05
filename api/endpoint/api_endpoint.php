<?php
namespace Backend\Api\Endpoint;

abstract class Api_Endpoint
{
    abstract protected function getAll();

    abstract protected function getById($id);

}


?>