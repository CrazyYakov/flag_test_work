<?php

declare(strict_types=1);

namespace Marketplace\Profile\Infrastructure\Manager;

use App\Models\ProductInCart;
use Marketplace\Profile\Core\Domain\Entities\Cart;
use Marketplace\Profile\Core\Domain\Entities\Product;
use Marketplace\Profile\Core\Domain\Entities\User;
use Marketplace\Profile\Infrastructure\Interfaces\CartManagerInterface;

class CartManger implements CartManagerInterface
{
    public function storeProductInCart(Cart $cart, Product $product): void
    {
        // TODO: Implement storeProductInCart() method.
    }

    public function removeProductInCart(Cart $cart, Product $product): void
    {
        // TODO: Implement removeProductInCart() method.
    }

    public function deleteCartAndCreateNew(User $user): Cart
    {
        // TODO: Implement deleteCartAndCreateNew() method.
    }

    public function getProductInCart(\App\Models\Cart $cart, \App\Models\Product $product): ?ProductInCart
    {
        return $cart->products()->where('product_id', $product->getKey())->first()?->productInCart;
    }
}
