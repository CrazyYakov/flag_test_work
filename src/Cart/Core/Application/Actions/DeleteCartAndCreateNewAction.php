<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Actions;

use Marketplace\Cart\Core\Domain\Aggregates\Cart;
use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;

class DeleteCartAndCreateNewAction
{
    public function __construct(
        private CartManagerInterface $cartManager,
    ) {}

    public function run(int $userId): Cart
    {
        return $this->cartManager->deleteCartAndCreateNew($userId);
    }
}
