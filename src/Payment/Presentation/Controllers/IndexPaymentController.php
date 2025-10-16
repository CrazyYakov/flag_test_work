<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Payment\Infrastructure\Interfaces\PaymentMethodRepositoryInterface;
use Marketplace\Payment\Presentation\Responses\SuccessResponse;
use Marketplace\Payment\Presentation\View\PaymentMethodListView;

readonly class IndexPaymentController
{
    public function __construct(
        private PaymentMethodRepositoryInterface $paymentMethodRepository
    ) {}

    public function __invoke(): Responsable
    {
        return new SuccessResponse(
            new PaymentMethodListView($this->paymentMethodRepository->all())
        );
    }
}
