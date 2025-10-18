<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Repositories;

use App\Models\Order as OrderModel;
use Marketplace\Cart\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Cart\Infrastructure\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function isLastOrderIsNotPayed(int $userId): bool
    {
        $lastOrder = OrderModel::query()
            ->where('user_id', $userId)
            ->latest()
            ->first();

        if ($lastOrder === null) {
            return false;
        }

        return $lastOrder->status->value == OrderStatusEnum::ON_PAYMENT->value;
    }
}
