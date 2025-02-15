<?php

namespace App\Infrastructure\Persistence;

use App\Core\Entities\Task;
use PDO;

class PgTaskRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findById(int $id): ?Task
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new Task($row["id"], $row["title"], $row["description"], $row["status"]) : null;
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM tasks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(Task $task): ?Task
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, status) 
                                    VALUES (:title, :description, :status) 
                                    RETURNING id");
        $stmt->execute([
            "title" => $task->getTitle(),
            "description" => $task->getDescription(),
            "status" => $task->getStatus()
        ]);

        $task->setId($stmt->fetchColumn()); // Obtiene el id devuelto por RETURNING
        return $task;
    }

    public function update(int $id, Task $task): bool
    {
        $stmt = $this->db->prepare("UPDATE tasks SET 
                                    title = :title, 
                                    description = :description, 
                                    status = :status 
                                    WHERE id = :id");
        return $stmt->execute([
            "title" => $task->getTitle(),
            "description" => $task->getDescription(),
            "status" => $task->getStatus(),
            "id" => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        return $stmt->execute(["id" => $id]);
    }
}
