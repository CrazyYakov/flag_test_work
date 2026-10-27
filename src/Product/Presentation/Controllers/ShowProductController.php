<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Product\Core\Ports\ProductRepositoryContract;
use Marketplace\Product\Presentation\Responses\SuccessResponse;
use Marketplace\Product\Presentation\View\ProductView;

readonly class ShowProductController
{
    public function __construct(
        private ProductRepositoryContract $productRepository
    ) {}

    public function __invoke(int $id): Responsable
    {
        $product = $this->productRepository->getById($id);

        return new SuccessResponse(
            new ProductView($product)
        );
    }
}
