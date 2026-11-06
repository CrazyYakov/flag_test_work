<?php

namespace Marketplace\Order\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;
use Marketplace\Order\Core\Domain\Aggregates\Order;
use Override;
use OpenApi\Attributes as OA;

/**
 * @implements Arrayable<string, mixed>
 */
#[OA\Schema(
    schema: 'OrderView',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'ID заказа', example: 1),
        new OA\Property(property: 'full_price', type: 'number', format: 'float', description: 'Итоговая стоимость заказа', example: 1999.98),
        new OA\Property(property: 'count', type: 'integer', description: 'Общее количество товаров в заказе', example: 2),
        new OA\Property(property: 'status', type: 'integer', description: 'Статус заказа', ),
        new OA\Property(
            property: 'products',
            type: 'array',
            items: new OA\Items(
                type: 'object',
                properties: [
                    new OA\Property(property: 'id', type: 'string', description: 'ID товара', example: '1'),
                    new OA\Property(property: 'title', type: 'string', example: 'iPhone 15'),
                    new OA\Property(property: 'price', type: 'number', format: 'float', description: 'Цена из резерва', example: 999.99),
                    new OA\Property(property: 'quantity', type: 'integer', description: 'Количество в заказе', example: 2),
                ],
            ),
        ),
    ],
)]
final class OrderView implements Arrayable
{
    public function __construct(
        private Order $order
    ) {}

    #[Override]
    public function toArray()
    {
        $order = $this->order;

        $products = [];

        foreach ($order->productList as $product) {
            $products[] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $product->quantity,
            ];
        }

        return [
            'id' => $order->id,
            'full_price' => $order->getFullPrice(),
            'count' => $order->getCount(),
            'status' => $order->status->value,
            'products' => $products,
        ];
    }
}
