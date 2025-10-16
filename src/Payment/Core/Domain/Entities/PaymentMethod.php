<?php

declare(strict_types=1);

namespace Marketplace\Payment\Core\Domain\Entities;

readonly class PaymentMethod
{
    public function __construct(
        public int $id,
        public string $title,
    )
    {

    }
}
