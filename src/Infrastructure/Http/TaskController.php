<?php

namespace App\Infrastructure\Http;

use App\Application\DTOs\TaskDTO;
use App\Application\Services\TaskService;
use App\Infrastructure\Persistence\Database;
use App\Infrastructure\Persistence\MysqlTaskRepository;
use App\Infrastructure\Persistence\MysqlUserRepository;
use Exception;

class TaskController extends Controller
{
    public function __construct()
    {
        // protegemos todo el controlador
        AuthMiddleware::validate();
    }

    public function getAllTask(): void
    {
        try {
            $pdo = Database::getConnection();
            $repository = new MysqlTaskRepository($pdo);
            $service = new TaskService($repository);

            $tasks = $service->getAllTasks();

            $this->sendResponse(200, $tasks->toArray());

        } catch (Exception $e) {
            $this->sendResponse(500, ["message" => "Internal Server Error", "error" => $e->getMessage()]);
        }
    }

    public function getTaskById(int $id): void
    {
        try {
            $pdo = Database::getConnection();
            $repository = new MysqlTaskRepository($pdo);
            $service = new TaskService($repository);

            $tasks = $service->getTaskById($id);

            if (!$tasks) {
                $this->sendResponse(404, ["message" => "Task not found"]);
                return;
            }

            $this->sendResponse(200, $tasks->toArray());

        } catch (Exception $e) {
            $this->sendResponse(500, ["message" => "Internal Server Error", "error" => $e->getMessage()]);
        }
    }

    public function createTask(): void
    {
        try {
            $pdo = Database::getConnection();
            $repository = new MysqlTaskRepository($pdo);
            $service = new TaskService($repository);

            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if (!isset($data['title'], $data['description'])) {
                $this->sendResponse(400, ["message" => "Faltan campos requeridos"]);
                return;
            }

            $taskDTO = new TaskDTO(
                id: null,
                title: $data['title'],
                description: $data['description'],
                status: "pending"
            );

            $tasks = $service->createTask($taskDTO);

            if (!$tasks) {
                $this->sendResponse(404, ["message" => "Task not found"]);
                return;
            }

            $this->sendResponse(201, $tasks->toArray());

        } catch (Exception $e) {
            $this->sendResponse(500, ["message" => "Internal Server Error", "error" => $e->getMessage()]);
        }
    }

    public function updateTask(int $id): void
    {
        try {
            $pdo = Database::getConnection();
            $repository = new MysqlTaskRepository($pdo);
            $service = new TaskService($repository);

            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if (!isset($data['title'], $data['description'], $data['status'])) {
                $this->sendResponse(400, ["message" => "Faltan campos requeridos"]);
                return;
            }

            $task = $service->getTaskById($id);
            if (is_null($task)) {
                $this->sendResponse(404, ["message" => "Task not found"]);
            }

            $taskDTO = new TaskDTO(
                id: null,
                title: $data['title'],
                description: $data['description'],
                status: $data['status']
            );

            $tasks = $service->updateTask($id, $taskDTO);

            if (!$tasks) {
                $this->sendResponse(200, ["message" => "No tasks updated"]);
                return;
            }

            $this->sendResponse(200, $tasks->toArray());

        } catch (Exception $e) {
            $this->sendResponse(500, ["message" => "Internal Server Error", "error" => $e->getMessage()]);
        }
    }

    public function deleteTask(int $id): void
    {
        try {
            $pdo = Database::getConnection();
            $repository = new MysqlTaskRepository($pdo);
            $service = new TaskService($repository);

            $task = $service->getTaskById($id);
            if (is_null($task)) {
                $this->sendResponse(404, ["message" => "Task not found"]);
            }

            $tasks = $service->deleteTask($id);

            if (!$tasks) {
                $this->sendResponse(200, ["message" => "No tasks deleted"]);
                return;
            }

            $this->sendResponse(200, ["message" => "Tasks deleted"]);

        } catch (Exception $e) {
            $this->sendResponse(500, ["message" => "Internal Server Error", "error" => $e->getMessage()]);
        }
    }
}
