<?php

namespace App\Core\Interfaces;

use App\Core\Entities\Task;

interface TaskRepositoryDAO
{
    public function findById(int $id): ?Task;
    public function findAll(): array;
    public function save(Task $task): ?Task;
    public function update(int $id, Task $task): bool;
    public function delete(int $id): bool;
}
