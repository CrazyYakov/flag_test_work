<?php

declare(strict_types=1);

namespace Marketplace\Order\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Order\Core\Application\Actions\PayOrderAction;
use Marketplace\Order\Presentation\Response\SuccessResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Order')]
class PaymentOrderController
{
    public function __construct(
        private PayOrderAction $payOrderAction
    ) {}

    #[OA\Post(
        path: '/api/orders/payed/{id}',
        operationId: 'payOrder',
        tags: ['Order'],
        summary: 'Отметка заказа как оплаченного',
        description: 'Устанавливает заказу статус PAID (2).',
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID заказа',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', example: 1),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Статус заказа обновлён',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(property: 'data', type: 'object', nullable: true),
                    ],
                ),
            ),
            new OA\Response(
                response: 404,
                description: 'Заказ с указанным ID не найден',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\Models\Order] 1'),
                    ],
                ),
            ),
            new OA\Response(
                response: 401,
                description: 'Не авторизован',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Unauthenticated.'),
                    ],
                ),
            ),
        ],
    )]
    public function __invoke(int $orderId): Responsable
    {
        $this->payOrderAction->run($orderId);

        return new SuccessResponse();
    }
}
