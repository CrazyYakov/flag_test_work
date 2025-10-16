<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Infrastructure\Interfaces\FilterInterface;

readonly class OrderFilter implements FilterInterface
{
    public function __construct(
        private OrderStatusEnum $status,
    ) {}

    public function apply(Builder $builder): Builder
    {
        return $builder->whereHas('status', function (Builder $builder) {
            $builder->where('slug', $this->status->value);
        });
    }
}
