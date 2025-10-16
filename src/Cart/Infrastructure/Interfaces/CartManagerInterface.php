<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Interfaces;


use Marketplace\Cart\Core\Domain\Aggregates\Cart;
use Marketplace\Cart\Core\Domain\Entities\Product;

interface CartManagerInterface
{
    public function storeProductInCart(Cart $cart, Product $product): void;

    public function removeProductInCart(Cart $cart, Product $product): void;

    public function deleteCartAndCreateNew(int $userId): Cart;
}
