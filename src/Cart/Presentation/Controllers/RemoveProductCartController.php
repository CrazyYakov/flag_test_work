<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Cart\Core\Application\Actions\RemoveProductFromCartAction;
use Marketplace\Cart\Presentation\Response\SuccessResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Cart')]
class RemoveProductCartController
{
    public function __construct(
        private RemoveProductFromCartAction $action
    ) {}

    #[OA\Delete(
        path: '/api/cart/{id}',
        operationId: 'removeProductFromCart',
        tags: ['Cart'],
        summary: 'Удаление товара из корзины',
        description: 'Удаляет товар по его ID из корзины текущего авторизованного пользователя.',
        security: [
            ['sanctum' => []],
        ],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID удаляемого товара',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', example: 1),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Товар удалён из корзины',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(property: 'data', type: 'object', nullable: true),
                    ],
                ),
            ),
            new OA\Response(
                response: 404,
                description: 'Товар с указанным ID не найден',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\Models\Product] 1'),
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
    public function __invoke(Request $request, int $id): Responsable
    {
        $user = $request->user();

        if ($user === null) {
            abort(401);
        }

        $this->action->run($user->id, $id);

        return new SuccessResponse();
    }
}
