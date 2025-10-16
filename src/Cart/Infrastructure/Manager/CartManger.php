<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Manager;

use App\Models\Cart as CartModel;
use App\Models\ProductInCart as ProductInCartModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Marketplace\Cart\Core\Domain\Aggregates\Cart;
use Marketplace\Cart\Core\Domain\Entities\Product;
use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;

class CartManger implements CartManagerInterface
{
    public function storeProductInCart(Cart $cart, Product $product): void
    {
        $cartModel = User::find($cart->userId)->cart;

        $productInCartModel = $this->getProductInCart($cartModel, $product);

        $count = $productInCartModel?->count + 1;

        $count > 1 ?
            $this->updateCountProductInCart($productInCartModel, $count) :
            $this->addProductInCart($cartModel, $product);
    }

    public function removeProductInCart(Cart $cart, Product $product): void
    {
        $cartModel = User::find($cart->userId)->cart;

        $productInCart = $this->getProductInCart($cartModel, $product);

        if ($productInCart === null) {
            return;
        }

        $count = $productInCart->count - 1;

        $count > 0 ?
            $this->updateCountProductInCart($productInCart, $count) :
            $this->detachProductInCart($cartModel, $product);
    }

    public function deleteCartAndCreateNew(int $userId): Cart
    {
        return DB::transaction(function () use ($userId) {
            $user = User::find($userId);

            $user->cart->products()->detach();

            $user->cart()->delete();

            return $user->cart()->create();
        });
    }

    public function getProductInCart(CartModel $cart, Product $product): ?ProductInCartModel
    {
        return $cart->products()->where('product_id', $product->id)->first()?->productInCart;
    }

    private function updateCountProductInCart(ProductInCartModel $productInCart, int $count): void
    {
        $productInCart->count = $count;
        $productInCart->save();
    }

    private function addProductInCart(CartModel $cart, Product $product): void
    {
        $cart->products()->attach($product->id, [
            'price' => $product->price,
            'count' => 1
        ]);
    }

    private function detachProductInCart(CartModel $cart, Product $product): void
    {
        $cart->products()->detach($product);
    }
}
