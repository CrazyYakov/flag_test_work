<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Services\Repositories\CartDto;

interface CartRepositoryInterface
{
    public function changeCountProductInCart(CartDto $cartDto): void;
}
