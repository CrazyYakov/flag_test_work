<?php

namespace Marketplace\Cart\Infrastructure\Repositories;

use App\Models\Product;
use App\Models\User;
use Marketplace\Cart\Core\Domain\Aggregates\Cart;
use Marketplace\Cart\Core\Domain\Entities\ProductCart;
use Marketplace\Cart\Core\Domain\Values\List\ProductInCartList;
use Marketplace\Cart\Infrastructure\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function getCartByUser(int $userId): Cart
    {
        $cartModel = User::findOrFail($userId)->cart->load('products');

        $productList = $cartModel->products
            ->map(function (Product $product) {
                return new ProductCart(
                    $product->id,
                    $product->productInCart->price,
                    $product->productInCart->count,
                    $product->title,
                );
            });

        return new Cart(
            new ProductInCartList($productList->all()),
            $userId
        );
    }
}
