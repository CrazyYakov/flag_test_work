<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class CancelOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отменяет заказ если прошло 2 минуты';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Order::query()
            ->whereDate('created_at', "<", now()->subMinutes(2))
            ->whereHas('')
            ->update([
                'status'
            ]);

        return static::SUCCESS;
    }
}
