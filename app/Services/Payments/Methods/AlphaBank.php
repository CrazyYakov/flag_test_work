<?php

namespace App\Services\Payments\Methods;

use App\Models\Order;
use App\Services\Payments\TokenService;

class AlphaBank implements PaymentMethodInterface
{
    public function __construct(
        private readonly TokenService $payment
    ) {}

    private Order $order;

    public function setOrder(Order $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getUrl(): string
    {
        $payload = [
            'order_id' => $this->order->getKey(),
        ];

        $token = $this->payment->encodeToken($payload);

        return url()->query("/api/payment/pay", [
            'token' => $token
        ]);
    }
}
