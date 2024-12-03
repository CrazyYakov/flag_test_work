<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\Order;
use App\Services\BuilderHelper\DataBuilderInterface;

interface OrderRepositoryInterface
{
    public function get(DataBuilderInterface $dataBuilder);

    public function getById(int $id): Order;

    public function updateStatus($status);
}
