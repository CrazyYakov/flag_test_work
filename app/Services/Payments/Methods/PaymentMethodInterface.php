<?php

namespace App\Services\Payments\Methods;

use App\Models\Order;

interface PaymentMethodInterface
{
    public function setOrder(Order $order): static;

    public function getUrl(): string;
}
