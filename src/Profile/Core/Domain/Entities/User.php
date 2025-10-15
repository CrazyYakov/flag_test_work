<?php

declare(strict_types=1);

namespace Marketplace\Profile\Core\Domain\Entities;

class User
{
    public function __construct(
        public readonly string $id,
        public readonly string $cartId,
    ) {}
}
