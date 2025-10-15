<?php

declare(strict_types=1);

namespace Marketplace\Auth\Core\Domain\Entities;

use Illuminate\Support\Facades\Hash;

readonly class User
{
    public function __construct(
        public int     $id,
        public string  $email,
        private string $password,
    ) {}

    public function checkPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}
