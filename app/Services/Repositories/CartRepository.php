<?php

namespace App\Services\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductInCart;
use App\Models\User;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartRepositoryInterface
{
    public function storeProductInCart(Cart $cart, Product $product): void
    {
        $productInCart = $this->getProductInCart($cart, $product);

        $count = $productInCart?->count + 1;

        $count > 1 ?
            $this->updateCountProductInCart($productInCart, $count) :
            $this->addProductInCart($cart, $product);
    }

    public function removeProductInCart(Cart $cart, Product $product): void
    {
        $productInCart = $this->getProductInCart($cart, $product);

        if ($productInCart === null) {
            return;
        }

        $count = $productInCart->count - 1;

        $count > 0 ?
            $this->updateCountProductInCart($productInCart, $count) :
            $this->detachProductInCart($cart, $product);
    }

    public function getCartByUser(User $user): Cart
    {
        return $user->cart;
    }

    public function getProductInCart(Cart $cart, Product $product): ?ProductInCart
    {
        return $cart->products()->where('product_id', $product->getKey())->first()?->productInCart;
    }

    private function addProductInCart(Cart $cart, Product $product): void
    {
        $cart->products()->attach($product, [
            'price' => $product->price,
            'count' => 1
        ]);
    }

    private function detachProductInCart(Cart $cart, Product $product): void
    {
        $cart->products()->detach($product);
    }

    private function updateCountProductInCart(ProductInCart $productInCart, int $count): void
    {
        $productInCart->count = $count;
        $productInCart->save();
    }

    public function getProducts(Cart $cart)
    {
        return $cart->products()->get();
    }

    public function deleteCartAndCreateNew(User $user): Cart
    {
        return DB::transaction(function () use ($user) {
            $user->cart->products()->detach();

            $user->cart()->delete();

            return $user->cart()->create();
        });
    }
}
