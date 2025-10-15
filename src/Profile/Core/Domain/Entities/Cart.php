<?php

declare(strict_types=1);

namespace Marketplace\Profile\Core\Domain\Entities;

use Marketplace\Product\Core\Domain\Values\Lists\ProductInCartList;

readonly class Cart
{
    public function __construct(
        public readonly ProductInCartList $productInCartList,
    ) {}
}
