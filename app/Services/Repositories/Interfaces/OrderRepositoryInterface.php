<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use App\Services\BuilderHelper\DataBuilderInterface;
use App\Services\Repositories\Order\OrderDataInterface;

interface OrderRepositoryInterface
{
    public function get(DataBuilderInterface $dataBuilder);

    public function getById(int $id): Order;

    public function updateStatus(Order $order, Status $status): void;

    public function create(OrderDataInterface $createOrder): Order;

    public function getLastOrder(User $user): ?Order;
}
