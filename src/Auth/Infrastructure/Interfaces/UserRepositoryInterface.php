<?php

namespace Marketplace\Auth\Infrastructure\Interfaces;

use Marketplace\Auth\Core\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function getByEmail(string $email): ?User;
}
