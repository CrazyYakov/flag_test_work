<?php

declare(strict_types=1);

namespace Marketplace\Auth\Infrastructure\Interfaces;

use Marketplace\Auth\Core\Domain\Entities\User;

interface UserMangerInterface
{
    public function createToken(User $user): string;

    public function createUser(string $email, string $password): User;
}
