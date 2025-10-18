<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Services;

use Illuminate\Support\Facades\DB;
use Marketplace\Cart\Infrastructure\Interfaces\TransactorInterface;

class Transactor implements TransactorInterface
{

    public function withTransaction(callable $transaction): void
    {
        DB::transaction($transaction);

    }
}
