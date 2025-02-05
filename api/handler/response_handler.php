<?php
namespace Backend\Api\Handler;

class Response_Handler {

    public function sendResponse($data){
        if ($data) {
            http_response_code(200);
            $response = [
                "success" => true,
                "data" => $data
            ];
        } else {
            http_response_code(404);
            $response = [
                "success" => false,
                "message" => "No data found"
            ];
        }
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

}