<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface CartRepositoryInterface
{
    public function storeProductInCart(Cart $cart, Product $product): void;

    public function removeProductInCart(Cart $cart, Product $product): void;

    public function getCartByUser(User $user): Cart;

    public function getProducts(Cart $cart): Collection;
}
