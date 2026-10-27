<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Service;

use Marketplace\Cart\Core\Ports\CartManagerContract;
use Marketplace\Cart\Core\Ports\TransactorContract;

class CartService
{
    public function __construct(
        private CartManagerContract $cartManager,
        private TransactorContract $transactor
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
