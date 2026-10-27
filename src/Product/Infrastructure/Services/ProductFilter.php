<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Marketplace\Product\Core\Ports\FilterContract;

readonly class ProductFilter implements FilterContract
{
    public function __construct(
        protected ?float $price
    ) {}

    public function apply(Builder $builder): Builder
    {
        return $builder->when($this->price !== null, fn($query) => $query->where('price', $this->price));
    }
}
