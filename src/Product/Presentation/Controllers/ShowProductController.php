<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Product\Core\Ports\ProductRepositoryContract;
use Marketplace\Product\Presentation\Responses\SuccessResponse;
use Marketplace\Product\Presentation\View\ProductView;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;

#[Tag(name: 'Product')]
readonly class ShowProductController
{
    public function __construct(
        private ProductRepositoryContract $productRepository
    ) {}

    #[Get(
        path: '/api/products/{id}',
        operationId: 'getProduct',
        tags: ['Product'],
        summary: 'Получение продукта по ID',
        parameters: [
            new Parameter(
                parameter: 'id',
                name: 'id',
                required: true,
                in: 'path',
                schema: new Schema(type: 'integer')
            ),
        ],
        responses: [
            new Response(
                response: 200,
                description: 'Продукт найден',
                content: new JsonContent(
                    properties: [
                        new Property(property: 'status', type: 'string', example: 'success'),
                        new Property(
                            property: 'data',
                            type: 'object',
                            ref: ProductView::class
                        ),
                    ],
                ),
            ),
        ]
    )]
    public function __invoke(int $id): Responsable
    {
        $product = $this->productRepository->getById($id);

        return new SuccessResponse(
            new ProductView($product)
        );
    }
}
