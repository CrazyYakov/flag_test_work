<?php

namespace Marketplace\Order\Infrastructure\Interfaces;

use Marketplace\Order\Core\Domain\Aggregates\Order;
use Marketplace\Order\Core\Domain\Values\List\OrderList;

interface OrderRepositoryInterface
{
    public function get(FilterInterface $filter, SorterInterface $sorter): OrderList;

    public function getById(int $id): Order;

    public function getLastOrder(int $userId): ?Order;
}
