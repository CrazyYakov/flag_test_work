<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Factories;

use Marketplace\Product\Core\Ports\FilterContract;
use Marketplace\Product\Infrastructure\Services\ProductFilter;

class ProductFilterFactory
{
    public function create(array $data): FilterContract
    {
        return new ProductFilter(
            price: $data['filter_price'] ?? null,
        );
    }
}
