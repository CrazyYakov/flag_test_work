<?php

namespace App\Services\Repositories;

use App\Services\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function changeCountProductInCart(CartDto $cartDto): void
    {
        $cart = $cartDto->getCart();
        $product = $cartDto->getProduct();

        $cart->products()->where('id', $product)->existsOr(function () use ($cartDto) {
            $cartDto->getCart()->products()->attach($cartDto->getProduct(), [
                'price' => $cartDto->getProduct()->price,
                'count' => $cartDto->getCount()
            ]);
        });

        $cart->products()->updateExistingPivot($product, [
            'count' => $cartDto->getCount()
        ]);
    }
}
