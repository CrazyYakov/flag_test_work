<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Repositories\Interfaces\StatusRepositoryInterface;
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
    public function handle(
        OrderRepositoryInterface  $orderRepository,
        StatusRepositoryInterface $statusRepository
    ): int
    {
        $onPaymentStatus = $statusRepository->getOnPaymentStatus();
        $cancelledStatus = $statusRepository->getCancelledStatus();

        $orders = Order::query()
            ->whereDate('created_at', "<", now()->subMinutes(2))
            ->whereHas('status', fn($query) => $query->where('id', $onPaymentStatus->getKey()))
            ->get();

        $orders->map(fn(Order $order) => $orderRepository->updateStatus($order, $cancelledStatus));

        return static::SUCCESS;
    }
}
