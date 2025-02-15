<?php

namespace App\Application\DTOs;

class TaskCollectionDTO
{
    private array $tasks;

    public function __construct(array $tasks)
    {
        $this->tasks = $tasks;
    }

    public function toArray(): array
    {
        return array_map(fn(TaskDTO $task) => $task->toArray(), $this->tasks);
    }
}
