<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Actions;

use Marketplace\Cart\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;
use Marketplace\Cart\Infrastructure\Interfaces\CartRepositoryInterface;

class AddProductToCartAction
{
    public function __construct(
        private CartManagerInterface $cartManager,
        private CartRepositoryInterface $cartRepository,
        private ProductRepositoryInterface $productRepository
    ) {}

    public function run(int $userId, int $productId): void
    {
        $product = $this->productRepository->getById($productId);

        $cart = $this->cartRepository->getCartByUser($userId);

        $this->cartManager->storeProductInCart($cart, $product);
    }
}
