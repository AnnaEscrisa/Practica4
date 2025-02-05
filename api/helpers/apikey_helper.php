<?php

namespace Backend\Api\Helpers;

use Backend\Model\ApiKey;
class ApiKey_Helper
{

    private $apikeyModel;
    public function __construct()
    {
        $this->apikeyModel = new ApiKey();
    }

    public function getHeaders()
    {
        $headers = getallheaders();

        if (!isset($headers['api-key'])) {
            http_response_code(401);
            echo json_encode(["error" => "Missing API KEY"]);
            exit;
        }
        return $headers['api-key'];
    }

    public function checkKey()
    {
        $key = $this->getHeaders();

        $validKey = $this->apikeyModel->comprovarKey($key);
        if (!$validKey) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid or expired API KEY"]);
            exit;
        }
        return $key;
    }

    public function checkAdminKey($key)
    {
        if (!str_contains($key, 'API_ADMIN')) {
            http_response_code(403);
            echo json_encode(["error" => "Permission denied"]);
            exit;
        }
    }
}