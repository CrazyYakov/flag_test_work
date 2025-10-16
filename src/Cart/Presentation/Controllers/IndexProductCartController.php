<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Cart\Infrastructure\Interfaces\CartRepositoryInterface;
use Marketplace\Cart\Presentation\Resources\ProductInCartResource;

class IndexProductCartController
{
    public function __construct(
        private CartRepositoryInterface $cartRepository,
    ) {}

    public function __invoke(Request $request): Responsable
    {
        $cart = $this->cartRepository->getCartByUser($request->user()->id);

        return ProductInCartResource::collection($cart->productInCartList);
    }
}
