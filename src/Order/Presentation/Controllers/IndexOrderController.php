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
use Marketplace\Order\Presentation\Response\SuccessResponse;
use Marketplace\Order\Presentation\View\OrderListView;
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
        security: [
            ['sanctum' => []],
        ],
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
                            ref: OrderListView::class,
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

        return new SuccessResponse(
            new OrderListView($orders)
        );
    }
}
