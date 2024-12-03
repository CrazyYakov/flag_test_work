<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private CartRepositoryInterface $cartRepository;
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param CartRepositoryInterface $cartRepository
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(CartRepositoryInterface $cartRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index(OrderRequest $orderRequest)
    {
        return $this->orderRepository->get($orderRequest);
    }

    public function updateOrder($id)
    {

    }

    public function payCart(Request $request)
    {
        $cart = $this->cartRepository->getCartByUser($request->user());


    }
}
