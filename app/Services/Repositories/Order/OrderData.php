<?php

namespace App\Services\Repositories\Order;

use App\Models\PaymentMethod;
use App\Models\Status;
use App\Models\User;

readonly class OrderData implements OrderDataInterface
{
    private PaymentMethod $paymentMethod;

    private User $user;
    private Status $status;

    public function __construct(
        PaymentMethod $paymentMethod,
        User          $user,
        Status        $status
    )
    {
        $this->paymentMethod = $paymentMethod;
        $this->user = $user;
        $this->status = $status;
    }


    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
