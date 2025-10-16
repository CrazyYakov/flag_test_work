<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Domain\Values\List;

use Iterator;
use Marketplace\Product\Core\Domain\Entities\Product;

class ProductList implements Iterator
{
    private array $products;
    private int $position;

    public function __construct(array $productList)
    {
        $this->products = $productList;
        $this->position = 0;
    }

    /**
     * @inheritDoc
     */
    public function current(): Product
    {
        return $this->products[$this->position];
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
        return array_key_exists($this->position, $this->products);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = 0;
    }
}
