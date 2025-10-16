<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Product\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Product\Presentation\Responses\SuccessResponse;
use Marketplace\Product\Presentation\View\ProductView;

readonly class ShowProductController
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function __invoke(int $id): Responsable
    {
        $product = $this->productRepository->getById($id);

        return new SuccessResponse(
            new ProductView($product)
        );
    }
}
