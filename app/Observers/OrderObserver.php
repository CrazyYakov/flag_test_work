<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;

class OrderObserver
{
    public function __construct(
        private CartRepositoryInterface $cartRepository,
    ) {}

    public function created(Order $order): void
    {
        $order->url = $this->getUrl($order);

        $order->setProductInCart($order->user->cart);

        $this->cartRepository->deleteCartAndCreateNew($order->user);
    }

    private function getUrl(Order $order): string
    {
        return $order->paymentMethod->getClass()->setOrder($order)->getUrl();
    }
}
