<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Interfaces;

interface OrderRepositoryInterface
{
    public function isLastOrderIsNotPayed(int $userId): bool;
}
