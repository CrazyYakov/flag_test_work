<?php

declare(strict_types=1);

namespace Marketplace\Product\Core\Domain\Factories;

use Marketplace\Product\Core\Domain\Entities\Product;

class ProductFactory
{
    /** @param array<string, mixed> $data */
    public function create(array $data): Product
    {
        return new Product(
            (int) $data['id'],
            (string) $data['title'],
            (float) $data['price'],
        );
    }
}
