<?php

declare(strict_types=1);

namespace Marketplace\Auth\Core\Application\Factories;

use Marketplace\Auth\Core\Domain\Entities\User;

class UserFactory
{
    public function create(array $data): User
    {
        return new User(
            $data['id'],
            $data['email'],
            $data['password'],
        );
    }
}
