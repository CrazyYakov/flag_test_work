<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Factories;

use Marketplace\Product\Infrastructure\Interfaces\FilterInterface;
use Marketplace\Product\Infrastructure\Services\ProductFilter;

class ProductFilterFactory
{
    public function create(array $data): FilterInterface
    {
        return new ProductFilter(
            price: $data['filter_price'],
        );
    }
}
