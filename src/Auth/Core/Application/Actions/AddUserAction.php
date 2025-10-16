<?php

declare(strict_types=1);

namespace Marketplace\Auth\Core\Application\Actions;

use Marketplace\Auth\Core\Application\Exceptions\UserExistException;
use Marketplace\Auth\Core\Domain\Entities\User;
use Marketplace\Auth\Infrastructure\Interfaces\UserMangerInterface;
use Marketplace\Auth\Infrastructure\Interfaces\UserRepositoryInterface;

class AddUserAction
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserMangerInterface $userManger
    ) {}

    /**
     * @throws UserExistException
     */
    public function run(string $email, string $name, string $password): User
    {
        $user = $this->userRepository->getByEmail($email);

        if ($user) {
            throw new UserExistException();
        }

        return $this->userManger->createUser($email, $name, $password);
    }
}
