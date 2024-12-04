<?php

namespace App\Services\Repositories;

use App\Exceptions\OrderExistException;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use App\Services\BuilderHelper\DataBuilderInterface;
use App\Services\Repositories\Interfaces\StatusRepositoryInterface;
use App\Services\Repositories\Order\OrderDataInterface;

class OrderRepository implements Interfaces\OrderRepositoryInterface
{
    public function get(DataBuilderInterface $dataBuilder)
    {
        return Order::query()->build($dataBuilder)->get();
    }

    public function updateStatus(Order $order, Status $status): void
    {
        $order->setStatus($status);
        $order->save();
    }

    public function getById(int $id): Order
    {
        return Order::query()->findOrFail($id);
    }

    /**
     * @throws OrderExistException
     */
    public function create(OrderDataInterface $createOrder): Order
    {
        $lastOrder = $this->getLastOrder($createOrder->getUser());

        $onPaymentStatus = $this->statusRepository()->getOnPaymentStatus();

        if ($lastOrder?->status->is($onPaymentStatus)) {
            throw new OrderExistException($lastOrder);
        }

        $order = new Order;
        $order->setUser($createOrder->getUser());
        $order->setPaymentMethod($createOrder->getPaymentMethod());
        $order->setStatus($createOrder->getStatus());
        $order->save();

        return $order;
    }

    public function getLastOrder(User $user): ?Order
    {
        return Order::query()->where('user_id', $user->getKey())->latest()->first();
    }

    private function statusRepository(): StatusRepositoryInterface
    {
        return app(StatusRepositoryInterface::class);
    }
}
