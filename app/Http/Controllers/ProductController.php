<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Resources\ProductResource;
use App\Services\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(ProductFilterRequest $request)
    {
        return ProductResource::collection($this->productRepository->get($request));
    }

    public function show($id): ProductResource
    {
        $product = $this->productRepository->getById($id);

        return new ProductResource($product);
    }
}
