<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Marketplace\Product\Infrastructure\Interfaces\FilterInterface;

readonly class ProductFilter implements FilterInterface
{
    public function __construct(
        protected float $price
    ) {}

    public function apply(Builder $builder): Builder
    {
        return $builder->where('price', $this->price);
    }
}
