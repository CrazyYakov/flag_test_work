<?php

namespace App\Services\Repositories;

use App\Models\Order;
use App\Services\BuilderHelper\DataBuilderInterface;

class OrderRepository implements Interfaces\OrderRepositoryInterface
{
    public function get(DataBuilderInterface $dataBuilder)
    {
        return Order::query()->build($dataBuilder)->simplePagination();
    }

    public function updateStatus(Order $order, $status): void
    {
        $order->status = $status;
        $order->save();
    }

    public function getById(int $id): Order
    {
        return Order::query()->findOrFail($id);
    }
}
