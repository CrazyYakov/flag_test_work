<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Interfaces;

use Marketplace\Cart\Core\Domain\Entities\Order;

interface OrderManagerInterface
{
    public function createOrder(int $userId, int $paymentMethodId): Order;

    public function generateUrl(Order $order): void;
}
