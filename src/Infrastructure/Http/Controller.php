<?php

namespace App\Infrastructure\Http;

class Controller
{
    public function sendResponse(int $statusCode, array $data): void
    {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
}
