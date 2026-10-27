<?php

declare(strict_types=1);

namespace Marketplace\Payment\Core\Ports;

interface PaymentMethodContract
{
    public function generateUrlForOrder(int $orderId): string;

    public function decodeTokenAndTakeOrderId(string $token): int;
}
