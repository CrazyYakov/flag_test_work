<?php

declare(strict_types=1);

namespace Marketplace\Payment\Infrastructure\Interfaces;

interface PaymentMethodInterface
{
    public function generateUrlForOrder(int $orderId): string;

    public function decodeTokenAndTakeOrderId(string $token): int;
}
