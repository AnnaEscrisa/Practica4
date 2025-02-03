<?php
namespace Backend\Api\Handler;

use Backend\Api\Endpoint\Articles_Endpoint;
use Backend\Api\Endpoint\Users_Endpoint;
use Backend\Api\Endpoint\ApiKey_Endpoint;
use Backend\Api\Handler\Methods_Handler;
use Backend\Api\Handler\Response_Handler;
use Backend\Api\Helpers\ApiKey_Helper;

class Routes_Handler
{
    private $routes;
    private $methodHandler;
    private $apiArticles;
    private $apiUsers;
    private $responseHandler;
    private $keyHelper;
    private $adminRoutes;

    public function __construct()
    {
        $this->routes = [
            'articles' => new Articles_Endpoint(),
            'users' => new Users_Endpoint(),
            'key' => new ApiKey_Endpoint(),
        ];
        $this->adminRoutes = ['users'];

        $this->methodHandler = new Methods_Handler();
        $this->responseHandler = new Response_Handler();
        $this->keyHelper = new ApiKey_Helper();

    }

    public function getRoute()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function transformRoute($ruta)
    {
        foreach (array_keys($this->routes) as $route) {
            if (str_contains($ruta, $route)) {
                return $route;
            }
        }

        return null;
    }

    public function handleRoute()
    {
        $key = '';
        $ruta = $this->getRoute();
        $rutaTransformada = $this->transformRoute($ruta);

        if (!$rutaTransformada) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        $endpoint = $this->routes[$rutaTransformada];

        if ($rutaTransformada !== 'key') {
            $key = $this->keyHelper->checkKey();
        }

        if (in_array($rutaTransformada, $this->adminRoutes)) {
            $key = $this->keyHelper->checkKey();
            $this->keyHelper->checkAdminKey($key);
        }

        if ($this->methodHandler->post() && method_exists($endpoint, 'create')) {
            $this->responseHandler->sendResponse($endpoint->create($_GET['id']));
        } elseif ($this->methodHandler->getId()) {
            $this->responseHandler->sendResponse($endpoint->getById($_GET['id']));
        } elseif ($this->methodHandler->get()) {
            $this->responseHandler->sendResponse($endpoint->getAll());
        }
    }


}








?>