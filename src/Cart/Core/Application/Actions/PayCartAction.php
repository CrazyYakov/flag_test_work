<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Application\Actions;

use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;

class PayCartAction
{
    public function __construct(
        private CartManagerInterface $cartManager,
    ) {}

    public function run(int $userId, int $paymentMethodId): void
    {
        $this->cartManager->payCart($userId, $paymentMethodId);
    }
}
