<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Factories;

use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Core\Ports\FilterContract;
use Marketplace\Order\Infrastructure\Services\OrderFilter;

class OrderFilterFactory
{
    /** @param array<string, mixed> $data */
    public function create(array $data): FilterContract
    {
        return new OrderFilter(
            status: OrderStatusEnum::from((int) $data['filter_status']),
        );
    }
}
