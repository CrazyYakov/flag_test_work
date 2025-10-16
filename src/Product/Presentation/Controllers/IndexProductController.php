<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Product\Infrastructure\Factories\ProductFilterFactory;
use Marketplace\Product\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Product\Infrastructure\Services\ProductSorter;
use Marketplace\Product\Infrastructure\Services\ProductSorterEnum;
use Marketplace\Product\Presentation\Requests\ProductFilterRequest;
use Marketplace\Product\Presentation\Responses\SuccessResponse;
use Marketplace\Product\Presentation\View\ProductListView;

readonly class IndexProductController
{
    public function __construct(
        private ProductFilterFactory $productFilterFactory,
        private ProductRepositoryInterface $productRepository,
    ) {}

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
