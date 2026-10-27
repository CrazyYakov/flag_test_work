<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Application\Actions;

use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Core\Ports\OrderManagerContract;

class PayOrderAction
{
    public function __construct(
        private OrderManagerContract $orderRepository,
    ) {}

    public function run(int $orderId): void
    {
        $this->orderRepository->updateStatus($orderId, OrderStatusEnum::PAID);
    }
}
