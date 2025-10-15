<?php

declare(strict_types=1);

namespace Marketplace\Product\Presentation\Controllers;

use App\Http\Resources\ProductResource;
use Marketplace\Product\Infrastructure\Interfaces\ProductRepositoryInterface;

readonly class ShowProductController
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function __invoke(int $id): ProductResource
    {
        $product = $this->productRepository->getById($id);

        return new ProductResource($product);
    }
}
