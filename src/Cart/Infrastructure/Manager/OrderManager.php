<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Manager;

use App\Models\Order as OrderModel;
use App\Models\PaymentMethod;
use App\Models\Product as ProductModel;
use App\Models\User;
use Marketplace\Cart\Core\Domain\Entities\Order;
use Marketplace\Cart\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Cart\Infrastructure\Interfaces\OrderManagerInterface;

class OrderManager implements OrderManagerInterface
{

    public function createOrder(int $userId, int $paymentMethodId): Order
    {
        $order = new OrderModel;
        $order->status = OrderStatusEnum::ON_PAYMENT->value;
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
                            'count' => $product->productInCart->count
                        ];
                    })
            );
    }
}
