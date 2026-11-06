<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Factories;

use Illuminate\Support\Arr;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Core\Ports\FilterContract;
use Marketplace\Order\Infrastructure\Services\OrderFilter;

class OrderFilterFactory
{
    /** @param array<string, mixed> $data */
    public function create(array $data): FilterContract
    {
        $filterStatus = Arr::get($data, 'filter_status');

        return new OrderFilter(
            status: $filterStatus ? OrderStatusEnum::from((int) $filterStatus) : null,
        );
    }
}
