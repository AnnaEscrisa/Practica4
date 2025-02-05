<?php
namespace Backend\Api\Endpoint;

use Backend\Api\Endpoint\Api_Endpoint;
use Backend\Model\Article;

class Articles_Endpoint extends Api_Endpoint
{
    private $articleModel;
    
    public function __construct(){
        $this->articleModel = new Article();
    }

    public function getAll()
    {
        return $this->articleModel->selectArticles();
    }

    public function getById($id)
    {
        return $this->articleModel->selectArticleById($id);
    }

}


?>