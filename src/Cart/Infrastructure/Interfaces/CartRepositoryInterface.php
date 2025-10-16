<?php

namespace Marketplace\Cart\Infrastructure\Interfaces;

use Marketplace\Cart\Core\Domain\Aggregates\Cart;

interface CartRepositoryInterface
{
    public function getCartByUser(int $userId): Cart;
}
