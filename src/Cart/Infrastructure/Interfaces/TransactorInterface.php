<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Interfaces;

interface TransactorInterface
{
    public function withTransaction(callable $transaction): void;
}
