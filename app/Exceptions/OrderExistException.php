<?php

namespace App\Exceptions;

use App\Models\Order;
use Exception;

class OrderExistException extends Exception
{
    private ?Order $order = null;

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }
}
