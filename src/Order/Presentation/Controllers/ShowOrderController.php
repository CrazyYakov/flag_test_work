<?php

declare(strict_types=1);

namespace Marketplace\Order\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Order\Infrastructure\Interfaces\OrderRepositoryInterface;
use Marketplace\Order\Presentation\Resources\OrderResource;

readonly class ShowOrderController
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
    ) {}

    public function __invoke(int $id): Responsable
    {
        return new OrderResource(
            $this->orderRepository->getById($id)
        );
    }
}
