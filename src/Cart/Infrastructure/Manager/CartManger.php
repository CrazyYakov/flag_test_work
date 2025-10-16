<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Manager;

use App\Models\Cart as CartModel;
use App\Models\Order as OrderModel;
use App\Models\PaymentMethod;
use App\Models\Pivot\ProductInCart as ProductInCartModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Marketplace\Cart\Core\Domain\Aggregates\Cart;
use Marketplace\Cart\Core\Domain\Entities\Product;
use Marketplace\Cart\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Cart\Infrastructure\Exception\CantPayCartException;
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

    public function deleteCartAndCreateNew(int $userId): void
    {
        DB::transaction(function () use ($userId) {
            $user = User::find($userId);

            $user->cart->products()->detach();

            $user->cart()->delete();

            $user->cart()->create();
        });
    }

    public function payCart(int $userId, int $paymentMethodId): void
    {
        throw_if($this->isLastOrderIsNotPayed($userId), new CantPayCartException());

        $order = new OrderModel;
        $order->status = OrderStatusEnum::ON_PAYMENT->value;
        $order->user_id = $userId;
        $order->payment_method_id = $paymentMethodId;

        $order->save();

        $order->url = PaymentMethod::find($paymentMethodId)
            ->getClass()
            ->generateUrlForOrder($order->id);

        $user = User::find($userId);

        $order->products()
            ->sync(
                $user->cart
                    ->products
                    ->keyBy('id')
                    ->map(function (\App\Models\Product $product) {
                        return [
                            'price' => $product->productInCart->price,
                            'count' => $product->productInCart->count
                        ];
                    })
            );

        $this->deleteCartAndCreateNew($userId);

        $order->save();
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

    protected function isLastOrderIsNotPayed(int $userId): bool
    {
        $lastOrder = OrderModel::query()
            ->where('user_id', $userId)
            ->latest()
            ->first();

        if ($lastOrder === null) {
            return false;
        }

        return $lastOrder->status->value == OrderStatusEnum::ON_PAYMENT->value;
    }
}
