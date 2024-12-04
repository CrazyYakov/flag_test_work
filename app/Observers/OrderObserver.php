<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;

class OrderObserver
{
    public function created(Order $order): void
    {
        $order->url = $this->getUrl($order);

        $order->setProductInCart($order->user->cart);

        $this->getCartRepository()->deleteCartAndCreateNew($order->user);
    }

    private function getCartRepository(): CartRepositoryInterface
    {
        return app(CartRepositoryInterface::class);
    }

    private function getUrl(Order $order): string
    {
        return $order->paymentMethod->getClass()->setOrder($order)->getUrl();
    }
}
