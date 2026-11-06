<?php

namespace Marketplace\Order\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Marketplace\Order\Core\Domain\Values\List\OrderList;
use OpenApi\Attributes as OA;

/**
 * @implements Arrayable<array-key, mixed>
 */
#[OA\Schema(
    schema: 'OrderListView',
    items: new OA\Items(
        ref: OrderView::class,
    ),
)]
final class OrderListView implements Arrayable
{
    public function __construct(
        private OrderList $orderList
    ) {}

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $result = [];

        foreach ($this->orderList as $order) {
            $result[] = (new OrderView($order))->toArray();
        }

        return $result;
    }
}
