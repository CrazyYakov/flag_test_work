<?php

namespace App\Services\Payments\Methods;

use App\Models\Order;
use App\Services\Payments\Payment;

class Bank implements PaymentMethodInterface
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

        $token = Payment::encodeToken($payload);

        return url()->query("/api/payment", [
            'token' => $token
        ]);
    }


}
