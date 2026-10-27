<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Marketplace\Product\Core\Ports\SorterContract;

readonly class ProductSorter implements SorterContract
{
    public function __construct(
        private ProductSorterEnum $name,
        private ?string            $direction,
    ) {}

    public function apply(Builder $builder): Builder
    {
        return $builder->orderBy($this->name->value, $this->direction ?? 'asc');
    }
}
