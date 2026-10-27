<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Actions;

use Marketplace\Cart\Core\Ports\ProductRepositoryContract;
use Marketplace\Cart\Core\Ports\CartManagerContract;
use Marketplace\Cart\Core\Ports\CartRepositoryContract;

class AddProductToCartAction
{
    public function __construct(
        private CartManagerContract $cartManager,
        private CartRepositoryContract $cartRepository,
        private ProductRepositoryContract $productRepository
    ) {}

    public function run(int $userId, int $productId): void
    {
        $product = $this->productRepository->getById($productId);

        $cart = $this->cartRepository->getCartByUser($userId);

        $this->cartManager->storeProductInCart($cart, $product);
    }
}
