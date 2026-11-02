<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Cart\Core\Application\Actions\PayCartAction;
use Marketplace\Cart\Core\Application\Exception\CantPayCartException;
use Marketplace\Cart\Presentation\Response\SuccessResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Cart')]
class PayCartController
{
    public function __construct(
        private PayCartAction $payCartAction
    ) {}

    #[OA\Post(
        path: '/api/cart/pay/{paymentMethodId}',
        operationId: 'payCart',
        tags: ['Cart'],
        summary: 'Оплата корзины',
        description: 'Создаёт заказ из содержимого корзины, генерирует платёжную ссылку выбранного способа оплаты и очищает корзину.',
        parameters: [
            new OA\Parameter(
                name: 'paymentMethodId',
                description: 'ID способа оплаты',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', example: 1),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Заказ создан и отправлен на оплату',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(property: 'data', type: 'object', nullable: true),
                    ],
                ),
            ),
            new OA\Response(
                response: 404,
                description: 'Способ оплаты не найден',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\Models\PaymentMethod] 1'),
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
    public function __invoke(Request $request, int $paymentMethodId): Responsable
    {
        $user = $request->user();

        if ($user === null) {
            abort(401);
        }

        try {
            $this->payCartAction->run(
                $user->id,
                $paymentMethodId,
            );
        } catch (CantPayCartException $e) {
            abort(400);
        }


        return new SuccessResponse();
    }
}
