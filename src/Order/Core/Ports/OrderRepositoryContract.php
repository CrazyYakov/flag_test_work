<?php

namespace Marketplace\Order\Core\Ports;

use Marketplace\Order\Core\Domain\Aggregates\Order;
use Marketplace\Order\Core\Domain\Values\List\OrderList;

interface OrderRepositoryContract
{
    public function get(FilterContract $filter, SorterContract $sorter): OrderList;

    public function getById(int $id): Order;

    public function getLastOrder(int $userId): ?Order;
}
