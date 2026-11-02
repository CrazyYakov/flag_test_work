<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Payment\Core\Application\Actions\GenerateUrlForPayedOrderAction;
use Marketplace\Payment\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Payment\Presentation\Responses\SuccessResponse;
use Marketplace\Payment\Presentation\View\UrlView;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Payment')]
class GenerateUrlController
{
    public function __construct(
        private GenerateUrlForPayedOrderAction $action,
    ) {}

    #[OA\Get(
        path: '/api/payment/payment/generate/url/{PaymentMethodEnum}',
        operationId: 'generatePaymentUrl',
        tags: ['Payment'],
        summary: 'Генерация ссылки для оплаты',
        description: 'Декодирует токен платежа, извлекает из него ID заказа и возвращает ссылку на подтверждение оплаты.',
        parameters: [
            new OA\Parameter(
                name: 'PaymentMethodEnum',
                description: 'Способ оплаты: alpha_bank или beta_bank',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string', enum: PaymentMethodEnum::class),
            ),
            new OA\Parameter(
                name: 'token',
                description: 'Токен платежа от банка, содержит ID заказа',
                in: 'query',
                required: true,
                schema: new OA\Schema(type: 'string', example: 'eyJhbGciOi...'),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Ссылка для подтверждения оплаты сформирована',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(property: 'data', ref: UrlView::class, type: 'object'),
                    ],
                ),
            ),
        ],
    )]
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
