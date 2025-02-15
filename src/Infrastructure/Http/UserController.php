<?php

namespace App\Infrastructure\Http;

use App\Application\Services\UserService;
use App\Infrastructure\Persistence\Database;
use App\Infrastructure\Persistence\MysqlUserRepository;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class UserController extends Controller
{
    public function getUserById($id): void
    {
        try {
            $pdo = Database::getConnection();
            $repository = new MySQLUserRepository($pdo);
            $service = new UserService($repository);

            $userDTO = $service->getUserById($id);

            if (!$userDTO) {
                $this->sendResponse(404, ["message" => "User not found"]);
                return;
            }

            $this->sendResponse(200, $userDTO->toArray());

        } catch (Exception $e) {
            $this->sendResponse(500, ["message" => "Internal Server Error", "error" => $e->getMessage()]);
        }
    }
}
