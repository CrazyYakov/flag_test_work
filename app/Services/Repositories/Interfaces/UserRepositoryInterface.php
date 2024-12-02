<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getByEmail(string $email): ?User;

    public function create(array $data): User;
}
