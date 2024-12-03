<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Resources\ProductResource;
use App\Services\BuilderHelper\DataBuilder;
use App\Services\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(ProductFilterRequest $request): AnonymousResourceCollection
    {
        $products = $this->productRepository->get($request);

        return ProductResource::collection($products);
    }

    public function show($id): ProductResource
    {
        $product = $this->productRepository->getById($id);

        return new ProductResource($product);
    }
}
