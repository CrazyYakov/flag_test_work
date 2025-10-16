<?php

declare(strict_types=1);

namespace Marketplace\Order\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Order\Core\Application\CreateOrderAction;
use Marketplace\Order\Presentation\Requests\StoreRequest;
use Marketplace\Order\Presentation\Resources\StoreResource;

class CreateOrderController
{
    public function __construct(
        private CreateOrderAction $createOrderAction
    ) {}

    public function __invoke(StoreRequest $request): Responsable
    {
        $order = $this->createOrderAction->run();

        return new StoreResource($order);
    }
}
