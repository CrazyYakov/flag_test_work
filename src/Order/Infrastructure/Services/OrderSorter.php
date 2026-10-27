<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Marketplace\Order\Core\Ports\SorterContract;

class OrderSorter implements SorterContract
{
    public function __construct(
        private OrderSorterEnum $orderColumn,
        private string          $direction,
    )
    {
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->orderBy($this->orderColumn->value, $this->direction);
    }
}
