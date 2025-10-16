<?php

namespace Marketplace\Payment\Infrastructure\Services\Banks;

use Marketplace\Payment\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Payment\Infrastructure\Interfaces\PaymentMethodInterface;
use Marketplace\Payment\Infrastructure\Services\TokenService;

class AlphaBank implements PaymentMethodInterface
{
    public function __construct(
        private readonly TokenService $payment
    ) {}

    public function generateUrlForOrder(int $orderId): string
    {
        $payload = [
            'order_id' => $orderId,
        ];

        $token = $this->payment->encodeToken($payload);

        return url()->query("/api/payment/pay/" . PaymentMethodEnum::ALPHA_BANK->value, [
            'token' => $token
        ]);
    }

    public function decodeTokenAndTakeOrderId(string $token): int
    {
        return $this->payment->decodeToken($token)->order_id;
    }
}
