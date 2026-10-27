<?php

declare(strict_types=1);

namespace Marketplace\Auth\Core\Ports;

use Marketplace\Auth\Core\Domain\Entities\User;

interface UserMangerContract
{
    public function createToken(User $user): string;

    public function createUser(string $email, string $name, string $password): User;
}
