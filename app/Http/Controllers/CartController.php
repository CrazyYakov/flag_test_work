<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductToCartRequest;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;


class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function store(StoreProductToCartRequest $request)
    {

    }

    public function remove(StoreProductToCartRequest $request)
    {

    }
}
