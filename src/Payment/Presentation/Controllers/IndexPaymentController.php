<?php

declare(strict_types=1);

namespace Marketplace\Payment\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Payment\Core\Ports\PaymentMethodRepositoryContract;
use Marketplace\Payment\Presentation\Responses\SuccessResponse;
use Marketplace\Payment\Presentation\View\PaymentMethodListView;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Payment')]
readonly class IndexPaymentController
{
    public function __construct(
        private PaymentMethodRepositoryContract $paymentMethodRepository
    ) {}

    #[OA\Get(
        path: '/api/payment/methods',
        operationId: 'getPaymentMethods',
        tags: ['Payment'],
        summary: 'Список способов оплаты',
        description: 'Возвращает доступные способы оплаты с их ID и названием.',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список способов оплаты',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                type: 'object',
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', description: 'ID способа оплаты', example: 1),
                                    new OA\Property(property: 'title', type: 'string', example: 'Alpha Bank'),
                                ],
                            ),
                        ),
                    ],
                ),
            ),
        ],
    )]
    public function __invoke(): Responsable
    {
        return new SuccessResponse(
            new PaymentMethodListView($this->paymentMethodRepository->all())
        );
    }
}
