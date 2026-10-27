<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Ports;

use Marketplace\Cart\Core\Domain\Entities\Order;

interface OrderManagerContract
{
    public function createOrder(int $userId, int $paymentMethodId): Order;

    public function generateUrl(Order $order): void;
}
