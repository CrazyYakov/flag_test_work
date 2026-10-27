<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Services;

use Illuminate\Support\Facades\DB;
use Marketplace\Cart\Core\Ports\TransactorContract;

class Transactor implements TransactorContract
{

    public function withTransaction(callable $transaction): void
    {
        DB::transaction($transaction);

    }
}
