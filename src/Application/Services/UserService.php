<?php

namespace App\Application\Services;

use App\Application\DTOs\UserDTO;
use App\Core\Interfaces\UserRepositoryDAO;

class UserService
{
    public function __construct(private readonly UserRepositoryDAO $repository)
    {
    }

    public function getUserById(int $id): ?UserDTO
    {
        $user = $this->repository->findById($id);
        return $user ? new UserDTO($user->getId(), $user->getName(), $user->getEmail()) : null;
    }
}
