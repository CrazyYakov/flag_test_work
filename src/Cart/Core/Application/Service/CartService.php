<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Service;

use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;
use Marketplace\Cart\Infrastructure\Interfaces\TransactorInterface;

class CartService
{
    public function __construct(
        private CartManagerInterface $cartManager,
        private TransactorInterface $transactor
    )
    {
    }

    public function deleteOldCartAndCreateNew(int $userId): void
    {
        $this->transactor->withTransaction(function () use ($userId) {
            $this->cartManager->deleteCart($userId);

            $this->cartManager->createNewCart($userId);
        });
    }
}
