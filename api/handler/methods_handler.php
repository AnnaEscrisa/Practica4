<?php

namespace Backend\Api\Handler;

class Methods_Handler {

    public function get(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            return true;
        }
    }
    
    public function getId(){
        $id = $_GET['id']?? null;
        if ($id){
            return true;
        }
    }
    
    public function post(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            return true;
        }
    }
    
    public function put(){
        if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
            return true;
        }
    }
    
    public function delete(){
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            return true;
        }
    }
}

?>