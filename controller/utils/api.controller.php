<?php
require 'vendor/autoload.php'; // Include Composer's autoload

use GuzzleHttp\Client;

function sendToQrMonkey($url, $payload)
{
    $client = new Client();

    try {
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($payload),
        ]);

        // Return the response body
        return $response->getBody()->getContents();
    } catch (\Exception $e) {
        throw new Exception("Error sending data to API: " . $e->getMessage());
    }
}