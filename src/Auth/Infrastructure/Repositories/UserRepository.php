<?php

namespace Marketplace\Auth\Infrastructure\Repositories;

use App\Models\User as UserModel;
use Marketplace\Auth\Core\Application\Factories\UserFactory;
use Marketplace\Auth\Core\Domain\Entities\User;
use Marketplace\Auth\Infrastructure\Interfaces\UserRepositoryInterface;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private UserFactory $userFactory
    ) {}

    public function getByEmail(string $email): ?User
    {
        return transform(
            UserModel::query()->firstWhere('email', $email),
            fn(UserModel $user) => $this->userFactory->create($user->toArray())
        );
    }
}
