<?php

declare(strict_types=1);

namespace Marketplace\Order\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Order\Infrastructure\Factories\OrderFilterFactory;
use Marketplace\Order\Infrastructure\Interfaces\OrderRepositoryInterface;
use Marketplace\Order\Infrastructure\Services\OrderSorter;
use Marketplace\Order\Infrastructure\Services\OrderSorterEnum;
use Marketplace\Order\Presentation\Requests\IndexRequest;
use Marketplace\Order\Presentation\Resources\OrderResource;

readonly class IndexOrderController
{
    public function __construct(
        private OrderFilterFactory $filterFactory,
        private OrderRepositoryInterface $orderRepository,
    ) {}

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
