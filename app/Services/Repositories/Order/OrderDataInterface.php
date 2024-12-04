<?php

namespace App\Services\Repositories\Order;

use App\Models\PaymentMethod;
use App\Models\Status;
use App\Models\User;

interface OrderDataInterface
{
    public function getPaymentMethod(): PaymentMethod;

    public function getUser(): User;

    public function getStatus(): Status;
}
