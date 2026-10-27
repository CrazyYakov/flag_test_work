<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Ports;

use DateTimeInterface;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;

interface OrderManagerContract
{
    public function updateStatus(int $orderId, OrderStatusEnum $status): void;

    public function cancelExpiredOrders(DateTimeInterface $date): void;
}
