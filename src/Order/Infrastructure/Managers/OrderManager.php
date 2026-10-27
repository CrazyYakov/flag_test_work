<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Managers;

use App\Models\Order as OrderModel;
use App\Models\PaymentMethod;
use App\Models\Product as ProductModel;
use App\Models\User;
use DateTimeInterface;
use Marketplace\Cart\Core\Domain\Entities\Order;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Core\Ports\OrderManagerContract;

class OrderManager implements OrderManagerContract
{
    public function createOrder(int $userId, int $paymentMethodId): Order
    {
        $order = new OrderModel;
        $order->status = OrderStatusEnum::ON_PAYMENT;
        $order->user_id = $userId;
        $order->payment_method_id = $paymentMethodId;
        $order->save();

        $this->moveProductCartToOrder($userId, $order);

        return new Order($order->id, $paymentMethodId);
    }

    public function generateUrl(Order $order): void
    {
        $orderModel = OrderModel::find($order->id);

        $orderModel->url = PaymentMethod::find($order->paymentMethodId)
            ->getClass()
            ->generateUrlForOrder($order->id);

        $orderModel->save();
    }

    private function moveProductCartToOrder(int $userId, OrderModel $order): void
    {
        $user = User::find($userId);

        $order->products()
            ->sync(
                $user->cart
                    ->products
                    ->keyBy('id')
                    ->map(function (ProductModel $product) {
                        return [
                            'price' => $product->productInCart->price,
                            'count' => $product->productInCart->count,
                        ];
                    })
            );
    }

    public function updateStatus(int $orderId, OrderStatusEnum $status): void
    {
        $order = OrderModel::query()->findOrFail($orderId);
        $order->status = $status;
        $order->save();
    }

    public function cancelExpiredOrders(DateTimeInterface $date): void
    {
        OrderModel::query()
            ->whereDate('created_at', "<", $date)
            ->where('status', OrderStatusEnum::ON_PAYMENT)
            ->update([
                'status' => OrderStatusEnum::CANCELED
            ]);
    }
}
