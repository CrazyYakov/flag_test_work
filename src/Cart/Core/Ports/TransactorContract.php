<?php

declare(strict_types=1);

namespace Marketplace\Cart\Core\Ports;

interface TransactorContract
{
    public function withTransaction(callable $transaction): void;
}
