<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Domain\Entities;

class Product
{
    public function __construct(
        public string $id,
        public string $title,
        public float $price,
        public float $quantity,
    ) {}

    public function getFullPrice(): float
    {
        return $this->price * $this->quantity;
    }
}
