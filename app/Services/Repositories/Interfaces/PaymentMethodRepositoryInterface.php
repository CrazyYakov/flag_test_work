<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\PaymentMethod;

interface PaymentMethodRepositoryInterface
{
    public function all();

    public function getById(int $id): PaymentMethod;
}
