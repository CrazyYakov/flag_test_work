<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\IndexRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\Order\StoreResource;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Services\Repositories\Interfaces\StatusRepositoryInterface;
use App\Services\Repositories\Order\OrderData;

class OrderController extends Controller
{
    private PaymentMethodRepositoryInterface $paymentMethodRepository;
    private OrderRepositoryInterface $orderRepository;
    private StatusRepositoryInterface $statusRepository;

    public function __construct(
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        OrderRepositoryInterface         $orderRepository,
        StatusRepositoryInterface        $statusRepository
    )
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->orderRepository = $orderRepository;
        $this->statusRepository = $statusRepository;
    }

    public function index(IndexRequest $orderRequest)
    {
        return $this->orderRepository->get($orderRequest);
    }

    public function show(int $id): StoreResource
    {
        $order = $this->orderRepository->getById($id);

        return new StoreResource($order);
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
