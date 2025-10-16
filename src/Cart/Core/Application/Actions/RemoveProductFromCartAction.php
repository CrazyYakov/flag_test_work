<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Actions;

use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;
use Marketplace\Cart\Infrastructure\Interfaces\CartRepositoryInterface;
use Marketplace\Cart\Infrastructure\Interfaces\ProductRepositoryInterface;

class RemoveProductFromCartAction
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

        $this->cartManager->removeProductInCart($cart, $product);
    }
}
