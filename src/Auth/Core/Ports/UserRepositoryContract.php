<?php

namespace Marketplace\Auth\Core\Ports;

use Marketplace\Auth\Core\Domain\Entities\User;

interface UserRepositoryContract
{
    public function getByEmail(string $email): ?User;
}
