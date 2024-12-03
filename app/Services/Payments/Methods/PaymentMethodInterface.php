<?php

namespace App\Services\Payments\Methods;

interface PaymentMethodInterface
{
    public function getUrl(): string;
}
