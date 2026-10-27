<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Ports;

interface OrderRepositoryContract
{
    public function isLastOrderIsNotPayed(int $userId): bool;
}
