<?php

namespace Marketplace\Order\Presentation\Commands;

use Illuminate\Console\Command;
use Marketplace\Order\Infrastructure\Interfaces\OrderManagerInterface;

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
    public function handle(OrderManagerInterface $orderManager): int
    {
        $orderManager->cancelExpiredOrders();

        return static::SUCCESS;
    }
}
