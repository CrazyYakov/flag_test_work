<?php

declare(strict_types=1);

namespace Marketplace\Order\Core\Domain\Aggregates;

use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Order\Core\Domain\Values\List\ProductList;

class Order
{
    public function __construct(
        public int               $id,
        public ProductList       $productList,
        public OrderStatusEnum   $status,
        public PaymentMethodEnum $paymentMethod,
        public string            $url,
    ) {}

    public function getFullPrice(): float
    {
        $total = 0;

        foreach ($this->productList as $product) {
            $total += $product->getFullPrice();
        }

        return $total;
    }

    public function getCount(): int
    {
        $total = 0;

        foreach ($this->productList as $product) {
            $total += $product->quantity;
        }

        return $total;
    }

}
