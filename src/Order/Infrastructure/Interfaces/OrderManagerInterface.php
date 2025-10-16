<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Interfaces;

use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;

interface OrderManagerInterface
{
    public function updateStatus(int $orderId, OrderStatusEnum $status): void;

    public function cancelExpiredOrders(): void;
}
