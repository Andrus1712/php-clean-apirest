<?php

namespace App\Infrastructure\Persistence;

use App\Core\Entities\Task;
use App\Core\Interfaces\TaskRepositoryDAO;
use PDO;

class MysqlTaskRepository implements TaskRepositoryDAO
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findById(int $id): ?Task
    {
        // TODO: Implement findById() method.
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new Task($row["id"], $row["title"], $row["description"], $row["status"]) : null;
    }

    public function findAll(): array
        // TODO: Implement findAll() method.
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks");
//        $stmt->bindValue();
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function save(Task $task): ?Task
    {
        // TODO: Implement save() method.
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)");
        $stmt->execute(array(
            "title" => $task->getTitle(),
            "description" => $task->getDescription(),
            "status" => $task->getStatus()
        ));
        $task->setId($this->db->lastInsertId());
        return $task;
    }

    public function update(int $id, Task $task): bool
    {
        // TODO: Implement update() method.
        $stmt = $this->db->prepare("UPDATE tasks SET 
                                title = :title, 
                                description = :description, 
                                status = :status 
                            WHERE id = :id");
        return $stmt->execute(array(
            "title" => $task->getTitle(),
            "description" => $task->getDescription(),
            "status" => $task->getStatus(),
            "id" => $id
        ));
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        return $stmt->execute(array(
            "id" => $id
        ));
    }
}
