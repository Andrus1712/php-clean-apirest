<?php

namespace App\Infrastructure\Http;

use App\Application\Services\JwtHandlerService;

class AuthMiddleware
{
    public static function validate(): ?array
    {
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';

        if (!$token || !str_starts_with($token, "Bearer ")) {
            http_response_code(401);
            echo json_encode(["message" => "Token no proporcionado"]);
            exit;
        }

        $jwt = new JwtHandlerService();
        $decoded = $jwt->validateToken(str_replace("Bearer ", "", $token));
        if (!$decoded) {
            http_response_code(401);
            echo json_encode(["message" => "Token inválido"]);
            exit;
        }

        return $decoded;
    }
}
