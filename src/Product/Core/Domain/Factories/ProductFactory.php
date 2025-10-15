<?php

declare(strict_types=1);

namespace Marketplace\Product\Core\Domain\Factories;

use Marketplace\Product\Core\Domain\Entities\Product;

class ProductFactory
{
    public function create(array $data): Product
    {
        return new Product(
            $data['id'],
            $data['title'],
            $data['price'],
        );
    }
}
