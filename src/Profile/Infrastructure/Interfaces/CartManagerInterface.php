<?php

declare(strict_types=1);

namespace Marketplace\Profile\Infrastructure\Interfaces;


use Marketplace\Profile\Core\Domain\Entities\Cart;
use Marketplace\Profile\Core\Domain\Entities\Product;
use Marketplace\Profile\Core\Domain\Entities\User;

interface CartManagerInterface
{
    public function storeProductInCart(Cart $cart, Product $product): void;

    public function removeProductInCart(Cart $cart, Product $product): void;

    public function deleteCartAndCreateNew(User $user): Cart;
}
