<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Factories;

use Marketplace\Product\Core\Ports\FilterContract;
use Marketplace\Product\Infrastructure\Services\ProductFilter;

class ProductFilterFactory
{
    /** @param array<string, mixed> $data */
    public function create(array $data): FilterContract
    {
        return new ProductFilter(
            price: isset($data['filter_price']) ? (float) $data['filter_price'] : null,
            search: isset($data['search']) ? (string) $data['search'] : null,
        );
    }
}
