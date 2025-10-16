<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Factories;

use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Infrastructure\Interfaces\FilterInterface;
use Marketplace\Order\Infrastructure\Services\OrderFilter;

class OrderFilterFactory
{
    public function create(array $data): FilterInterface
    {
        return new OrderFilter(
            status: OrderStatusEnum::from($data['filter_status']),
        );
    }
}
