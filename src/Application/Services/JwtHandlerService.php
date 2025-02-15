<?php

namespace App\Application\Services;

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandlerService
{
    private string $secret;
    private string $alg;

    public function __construct()
    {
        $this->secret = $_ENV['JWT_SECRET'] ?? 'default_secret';
        $this->alg = 'HS256';
    }

    public function generateToken(array $payload, int $exp = 3600): string
    {
        $issuedAt = time();
        $expireAt = $issuedAt + $exp;

        $payload['iat'] = $issuedAt;
        $payload['exp'] = $expireAt;

        return JWT::encode($payload, $this->secret, $this->alg);
    }

    public function validateToken(string $token): ?array
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secret, $this->alg));
            return (array)$decoded;
        } catch (\Exception $e) {
            return null;
        }
    }
}
