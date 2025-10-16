<?php

declare(strict_types=1);

namespace Marketplace\Order\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;

use Marketplace\Order\Core\Application\Actions\PayOrderAction;
use Marketplace\Order\Presentation\Response\SuccessResponse;

class PaymentOrderController
{
    public function __construct(
        private PayOrderAction $payOrderAction
    )
    {
    }

    public function __invoke(int $orderId): Responsable
    {
        $this->payOrderAction->run($orderId);

        return new SuccessResponse();
    }
}
