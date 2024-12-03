<?php

namespace App\Services\Repositories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

class PaymentMethodRepository implements Interfaces\PaymentMethodRepositoryInterface
{
    public function all(): Collection
    {
        return PaymentMethod::all();
    }

    public function getById(int $id): PaymentMethod
    {
        return PaymentMethod::query()->findOrFail($id);
    }
}
