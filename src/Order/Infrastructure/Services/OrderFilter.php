<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Core\Ports\FilterContract;

readonly class OrderFilter implements FilterContract
{
    public function __construct(
        private ?OrderStatusEnum $status,
    ) {}

    public function apply(Builder $builder): Builder
    {
        return $builder->when($this->status, fn(Builder $query) => $query->where('status', $this->status));
    }
}
