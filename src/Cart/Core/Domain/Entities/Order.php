<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Domain\Entities;

readonly class Order
{
    public function __construct(
        public int $id,
        public int $paymentMethodId,
    ) {}
}
