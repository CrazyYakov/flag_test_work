<?php

declare(strict_types=1);

namespace Marketplace\Auth\Infrastructure\Manager;

use Marketplace\Auth\Core\Application\Factories\UserFactory;
use Marketplace\Auth\Core\Domain\Entities\User;
use Marketplace\Auth\Infrastructure\Interfaces\UserMangerInterface;

class UserManager implements UserMangerInterface
{
    public function __construct(
        private UserFactory $userFactory
    ) {}

    public function createToken(User $user): string
    {
        $user = \App\Models\User::query()->find($user->id);

        return $user->createToken('token')->plainTextToken;
    }

    public function createUser(string $email, string $name, string $password): User
    {
        $model = new \App\Models\User();
        $model->email = $email;
        $model->password = $password;
        $model->name = $name;
        $model->save();

        return $this->userFactory->create($model->toArray());
    }
}
