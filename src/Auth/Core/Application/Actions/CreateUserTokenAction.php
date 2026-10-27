<?php

declare(strict_types=1);

namespace Marketplace\Auth\Core\Application\Actions;

use Marketplace\Auth\Core\Domain\Entities\User;
use Marketplace\Auth\Core\Ports\UserMangerContract;

class CreateUserTokenAction
{
    public function __construct(
        private readonly UserMangerContract $userManger,
    ) {}

    public function run(User $user): string
    {
        return $this->userManger->createToken($user);
    }
}
