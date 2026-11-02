<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Product\Infrastructure\Factories\ProductFilterFactory;
use Marketplace\Product\Core\Ports\ProductRepositoryContract;
use Marketplace\Product\Infrastructure\Services\ProductSorter;
use Marketplace\Product\Infrastructure\Services\ProductSorterEnum;
use Marketplace\Product\Presentation\Requests\ProductFilterRequest;
use Marketplace\Product\Presentation\Responses\SuccessResponse;
use Marketplace\Product\Presentation\View\ProductListView;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Tag;

#[Tag(name: 'Product')]
readonly class IndexProductController
{
    public function __construct(
        private ProductFilterFactory $productFilterFactory,
        private ProductRepositoryContract $productRepository,
    ) {}


    #[Get(
        path: '/api/products',
        operationId: 'getProducts',
        tags: ['Product'],
        summary: 'Список продуктов',
        parameters: [
            new Parameter(
                parameter: 'filter_price',
                name: 'filter_price',
                in: 'query',
                required: false,
                schema: new Schema(type: 'float')
            ),
            new Parameter(
                parameter: 'sort_price_dir',
                name: 'sort_price_dir',
                in: 'query',
                required: false,
                schema: new Schema(type: 'string')
            )
        ],
        responses: [
            new Response(
                response: 200,
                description: 'Список продуктов',
                content: new JsonContent(
                    properties: [
                        new Property(property: 'status', type: 'string', example: 'success'),
                        new Property(
                            property: 'data',
                            type: 'array',
                            items: new Items(
                                type: 'object',
                                properties: [
                                    new Property(property: 'id', type: 'integer', example: 1),
                                    new Property(property: 'title', type: 'string', example: 'Product Name'),
                                    new Property(property: 'price', type: 'number', format: 'float', example: 100.50),
                                ],
                            ),
                        ),
                    ],
                ),
            ),
        ]
    )]
    public function __invoke(ProductFilterRequest $request): Responsable
    {
        $filter = $this->productFilterFactory
            ->create($request->all());

        $sorter = new ProductSorter(ProductSorterEnum::PRICE, $request->sort_price_dir);

        return new SuccessResponse(
            new ProductListView(
                $this->productRepository->get($filter, $sorter)
            )
        );
    }
}
