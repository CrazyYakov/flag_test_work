<?php

namespace App\Services\Repositories;

use App\Models\User;

class UserRepository implements Interfaces\UserRepositoryInterface
{
    public function getByEmail(string $email): ?User
    {
        return User::query()->firstWhere('email', $email);
    }

    public function create(array $data): User
    {
        return User::query()->create($data);
    }
}
