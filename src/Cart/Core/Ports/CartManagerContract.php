<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Ports;


use Marketplace\Cart\Core\Domain\Aggregates\Cart;
use Marketplace\Cart\Core\Domain\Entities\Product;

interface CartManagerContract
{
    public function storeProductInCart(Cart $cart, Product $product): void;

    public function removeProductInCart(Cart $cart, Product $product): void;

    public function deleteCart(int $userId): void;

    public function createNewCart(int $userId): void;
}
