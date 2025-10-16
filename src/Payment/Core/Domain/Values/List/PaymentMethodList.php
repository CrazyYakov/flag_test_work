<?php

declare(strict_types=1);

namespace Marketplace\Payment\Core\Domain\Values\List;

use Marketplace\Payment\Core\Domain\Entities\PaymentMethod;

class PaymentMethodList implements \Iterator
{
    private array $list;
    private int $position;

    public function __construct(array $productList)
    {
        $this->list = $productList;
        $this->position = 0;
    }

    /**
     * @inheritDoc
     */
    public function current(): PaymentMethod
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
