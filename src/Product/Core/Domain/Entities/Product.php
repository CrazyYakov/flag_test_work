<?php

declare(strict_types=1);

namespace Marketplace\Product\Core\Domain\Entities;

readonly class Product
{
    public function __construct(
        public string $id,
        public string $title,
        public float $price,
    ) {}
}
