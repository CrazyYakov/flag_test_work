<?php

namespace App\Services\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ReservedProduct;
use App\Models\User;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CartRepository implements CartRepositoryInterface
{
    public function storeProductInCart(Cart $cart, Product $product): void
    {
        $reservedProduct = $this->getReservedProduct($cart, $product);

        $count = $reservedProduct->count + 1;

        $reservedProduct ?
            $this->updateCountReservedProduct($reservedProduct, $count) :
            $this->addProductInCart($cart, $product);
    }

    public function removeProductInCart(Cart $cart, Product $product): void
    {
        $reservedProduct = $this->getReservedProduct($cart, $product);

        if ($reservedProduct === null) {
            return;
        }

        $count = $reservedProduct->count - 1;

        $count > 0 ?
            $this->updateCountReservedProduct($reservedProduct, $count) :
            $this->detachProductInCart($cart, $product);
    }

    public function getCartByUser(User $user): Cart
    {
        return $user->cart;
    }

    public function getReservedProduct(Cart $cart, Product $product): ?ReservedProduct
    {
        return $cart->products()->firstWhere('id', $product->getKey())?->reservedProduct;
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

    private function updateCountReservedProduct(ReservedProduct $reservedProduct, int $count): void
    {
        $reservedProduct->count = $count;
        $reservedProduct->save();
    }

    public function getProducts(Cart $cart): Collection
    {
        return $cart->products()->get()->map(fn(Product $product) => $product->reservedProduct);
    }
}
