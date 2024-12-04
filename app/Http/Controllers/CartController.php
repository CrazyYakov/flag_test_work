<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductInCartResource;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;
    private ProductRepositoryInterface $productRepository;

    public function __construct(
        CartRepositoryInterface    $cartRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $cart = $this->cartRepository->getCartByUser($request->user());

        $products = $this->cartRepository->getProducts($cart);

        return ProductInCartResource::collection($products);
    }

    public function store(Request $request, int $id): AnonymousResourceCollection
    {
        $cart = $this->cartRepository->getCartByUser($request->user());

        $this->cartRepository->storeProductInCart(
            cart: $cart,
            product: $this->productRepository->getById($id)
        );

        $products = $this->cartRepository->getProducts($cart);

        return ProductInCartResource::collection($products);
    }

    public function remove(Request $request, int $id): AnonymousResourceCollection
    {
        $cart = $this->cartRepository->getCartByUser($request->user());

        $this->cartRepository->removeProductInCart(
            cart: $cart,
            product: $this->productRepository->getById($id)
        );

        $products = $this->cartRepository->getProducts($cart);

        return ProductInCartResource::collection($products);
    }
}
