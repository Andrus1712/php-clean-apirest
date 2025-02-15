<?php

namespace App\Application\Services;

use App\Application\DTOs\TaskCollectionDTO;
use App\Application\DTOs\TaskDTO;
use App\Core\Entities\Task;
use App\Core\Interfaces\TaskRepositoryDAO;

class TaskService
{
    public function __construct(private readonly TaskRepositoryDAO $repository)
    {
    }

    public function getAllTasks(): TaskCollectionDTO
    {
        $tasks = $this->repository->findAll();
        $taskDTOs = array_map(fn($task) => new TaskDTO(
            $task['id'],
            $task['title'],
            $task['description'],
            $task['status']
        ), $tasks);

        return new TaskCollectionDTO($taskDTOs);
    }

    public function getTaskById(int $id): ?TaskDTO
    {
        $task = $this->repository->findById($id);
        return $task ? new TaskDTO($task->getId(), $task->getTitle(), $task->getDescription(), $task->getStatus()) : null;
    }

    public function createTask(TaskDTO $taskDTO): ?TaskDTO
    {
        $task_aux = new Task(
            id: null,
            title: $taskDTO->title,
            description: $taskDTO->description,
            status: $taskDTO->status
        );
        $task = $this->repository->save($task_aux);
        return $task ? new TaskDTO($task->getId(), $task->getTitle(), $task->getDescription(), $task->getStatus()) : null;
    }

    public function updateTask(int $id, TaskDTO $taskDTO): ?TaskDTO
    {
        $task_aux = new Task(
            id: null,
            title: $taskDTO->title,
            description: $taskDTO->description,
            status: $taskDTO->status
        );
        $task_update = $this->repository->update($id, $task_aux);
        return $task_update ? new TaskDTO($id, $task_aux->getTitle(), $task_aux->getDescription(), $task_aux->getStatus()) : null;
    }

    public function deleteTask(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
