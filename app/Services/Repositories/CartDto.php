<?php

namespace App\Services\Repositories;

use App\Models\Cart;
use App\Models\Product;

readonly class CartDto
{
    private Cart $cart;
    private Product $product;
    private int $count;

    public function __construct(Cart $cart, Product $product, int $count)
    {
        $this->cart = $cart;
        $this->product = $product;
        $this->count = $count;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
