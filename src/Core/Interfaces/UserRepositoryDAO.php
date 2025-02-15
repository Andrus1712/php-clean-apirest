<?php

namespace App\Core\Interfaces;

use App\Core\Entities\User;

interface UserRepositoryDAO
{
    public function findById(int $id): ?User;
}
