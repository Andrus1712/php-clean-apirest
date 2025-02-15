<?php

namespace App\Infrastructure\Http;

use App\Application\Services\JwtHandlerService;
use App\Infrastructure\Persistence\Database;
use PDO;

class AuthController extends Controller
{
    public function login(): void
    {
        $pdo = Database::getConnection();

        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (!isset($data['email'], $data['password'])) {
            $this->sendResponse(400, ["message" => "Faltan campos requeridos"]);
            return;
        }

        $email = $data['email'];
        $password = $data['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $jwt = new JwtHandlerService();
            $token = $jwt->generateToken(['user_id' => $user['id'], 'email' => $user['email']]);

            echo json_encode(['token' => $token]);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Credenciales inválidas']);
        }
    }
}
