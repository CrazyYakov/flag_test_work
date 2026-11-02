<?php

declare(strict_types=1);

namespace Marketplace\Order\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Order\Infrastructure\Factories\OrderFilterFactory;
use Marketplace\Order\Core\Ports\OrderRepositoryContract;
use Marketplace\Order\Infrastructure\Services\OrderSorter;
use Marketplace\Order\Infrastructure\Services\OrderSorterEnum;
use Marketplace\Order\Presentation\Requests\IndexRequest;
use Marketplace\Order\Presentation\Resources\OrderResource;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Order')]
readonly class IndexOrderController
{
    public function __construct(
        private OrderFilterFactory $filterFactory,
        private OrderRepositoryContract $orderRepository,
    ) {}

    #[OA\Get(
        path: '/api/orders',
        operationId: 'getOrders',
        tags: ['Order'],
        summary: 'Получение списка заказов',
        description: 'Возвращает список заказов с фильтрацией по статусу и сортировкой по дате создания.',
        parameters: [
            new OA\Parameter(
                name: 'filter_status',
                description: 'Фильтр по статусу заказа: 1 — на оплату, 2 — оплачен, 3 — отменён',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', enum: [1, 2, 3], example: 2),
            ),
            new OA\Parameter(
                name: 'sort_created_at',
                description: 'Направление сортировки по дате создания, передаётся в orderBy',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string', enum: ['asc', 'desc'], example: 'desc'),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список заказов',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                type: 'object',
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', description: 'ID заказа', example: 1),
                                    new OA\Property(property: 'full_price', type: 'number', format: 'float', description: 'Итоговая стоимость заказа', example: 1999.98),
                                    new OA\Property(property: 'count', type: 'integer', description: 'Общее количество товаров в заказе', example: 2),
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
                            ),
                        ),
                        new OA\Property(property: 'message', type: 'string', example: 'order'),
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                    ],
                ),
            ),
            new OA\Response(
                response: 422,
                description: 'Ошибка валидации query-параметров',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The filter status field must be an integer.'),
                        new OA\Property(
                            property: 'errors',
                            type: 'object',
                            additionalProperties: new OA\AdditionalProperties(
                                type: 'array',
                                items: new OA\Items(type: 'string'),
                            ),
                        ),
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
    public function __invoke(IndexRequest $request): Responsable
    {
        $orders = $this->orderRepository->get(
            $this->filterFactory->create($request->toArray()),
            new OrderSorter(
                OrderSorterEnum::CREATED_AT,
                $request->sort_created_at
            )
        );

        return OrderResource::collection($orders);
    }
}
