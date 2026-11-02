<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Domain\Values\List;

use Iterator;
use Marketplace\Order\Core\Domain\Aggregates\Order;

/**
 * @implements Iterator<int, Order>
 */
class OrderList implements Iterator
{
    /** @var array<int, Order> */
    private array $list;
    private int $position;

    /** @param array<int, Order> $list */
    public function __construct(array $list)
    {
        $this->list = $list;
        $this->position = 0;
    }

    /**
     * @inheritDoc
     */
    public function current(): Order
    {
        return $this->list[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return array_key_exists($this->position, $this->list);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = 0;
    }
}
