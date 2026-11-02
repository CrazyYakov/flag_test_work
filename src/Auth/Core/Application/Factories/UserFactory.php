<?php

declare(strict_types=1);

namespace Marketplace\Auth\Core\Application\Factories;

use Marketplace\Auth\Core\Domain\Entities\User;

class UserFactory
{
    /** @param array<string, mixed> $data */
    public function create(array $data): User
    {
        return new User(
            (int) $data['id'],
            (string) $data['email'],
            (string) $data['password'],
        );
    }
}
