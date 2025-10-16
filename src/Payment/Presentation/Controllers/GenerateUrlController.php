<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Payment\Core\Application\Actions\GenerateUrlForPayedOrderAction;
use Marketplace\Payment\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Payment\Presentation\Responses\SuccessResponse;
use Marketplace\Payment\Presentation\View\UrlView;

class GenerateUrlController
{
    public function __construct(
        private GenerateUrlForPayedOrderAction $action,
    )
    {
    }

    public function __invoke(Request $request, PaymentMethodEnum $paymentMethod): Responsable
    {
        $url = $this->action->run(
            $paymentMethod,
            $request->get('token')
        );

        return new SuccessResponse(
            new UrlView($url)
        );
    }
}
