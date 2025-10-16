<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Domain\Aggregates;

use Marketplace\Cart\Core\Domain\Values\List\ProductInCartList;

readonly class Cart
{
    public function __construct(
        public ProductInCartList $productInCartList,
        public int $userId,
    ) {}
}
