<?php

namespace App\Infrastructure\Persistence;

use App\Core\Entities\User;
use App\Core\Interfaces\UserRepositoryDAO;
use PDO;

class MysqlUserRepository implements UserRepositoryDAO
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new User($row["id"], $row["name"], $row["email"]) : null;
    }
}
