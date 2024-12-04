<?php

namespace App\Services\Payments\Methods;

use App\Models\Order;
use App\Services\Payments\Payment;

class BetaBank implements PaymentMethodInterface
{
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

        return url("/api/payment", [
            'token' => Payment::encodeToken($payload)
        ]);
    }
}
