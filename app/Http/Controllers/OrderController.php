<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\IndexRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\StoreResource;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Services\Repositories\Interfaces\StatusRepositoryInterface;
use App\Services\Repositories\Order\OrderData;

class OrderController extends Controller
{
    public function __construct(
        private readonly  PaymentMethodRepositoryInterface $paymentMethodRepository,
        private readonly  OrderRepositoryInterface         $orderRepository,
        private readonly  StatusRepositoryInterface        $statusRepository
    ) {}

    public function index(IndexRequest $orderRequest)
    {
        return $this->orderRepository->get($orderRequest);
    }

    public function show(int $id): OrderResource
    {
        $order = $this->orderRepository->getById($id);

        return new OrderResource($order);
    }

    public function store(StoreRequest $request): StoreResource
    {
        $paymentMethodId = $request->json('data.payment_method_id');

        $paymentMethod = $this->paymentMethodRepository->getById($paymentMethodId);

        $createOrder = new OrderData(
            paymentMethod: $paymentMethod,
            user: $request->user(),
            status: $this->statusRepository->getOnPaymentStatus()
        );

        $order = $this->orderRepository->create($createOrder);

        return new StoreResource($order);
    }
}
