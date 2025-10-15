<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\Controllers;

use App\Http\Requests\ProductFilterRequest;
use Illuminate\Contracts\Support\Responsable;
use Marketplace\Product\Infrastructure\Factories\ProductFilterFactory;
use Marketplace\Product\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Product\Infrastructure\Services\ProductSorter;
use Marketplace\Product\Infrastructure\Services\ProductSorterEnum;
use Marketplace\Product\Presentation\Resources\ProductResource;

readonly class IndexProductController
{
    public function __construct(
        private ProductFilterFactory $productFilterFactory,
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function __invoke(ProductFilterRequest $request): Responsable
    {
        $filter = $this->productFilterFactory
            ->create($request->toArray());

        $sorter = new ProductSorter(ProductSorterEnum::PRICE, $request->sort_price_dir);

        return ProductResource::collection(
            $this->productRepository->get($filter, $sorter)
        );
    }
}
