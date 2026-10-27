<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Payment\Core\Ports\PaymentMethodRepositoryContract;
use Marketplace\Payment\Presentation\Responses\SuccessResponse;
use Marketplace\Payment\Presentation\View\PaymentMethodListView;

readonly class IndexPaymentController
{
    public function __construct(
        private PaymentMethodRepositoryContract $paymentMethodRepository
    ) {}

    public function __invoke(): Responsable
    {
        return new SuccessResponse(
            new PaymentMethodListView($this->paymentMethodRepository->all())
        );
    }
}
