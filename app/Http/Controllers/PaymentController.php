<?php

namespace App\Http\Controllers;

use App\Http\Resources\Order\StoreResource;
use App\Services\Payments\Payment;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Repositories\Interfaces\StatusRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private StatusRepositoryInterface $statusRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        StatusRepositoryInterface $statusRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->statusRepository = $statusRepository;
    }

    public function pay(Request $request): array
    {
        $payloadToken = Payment::decodeToken($request->get('token'));

        $order = $this->orderRepository->getById($payloadToken->order_id);

        $this->orderRepository->updateStatus(
            order: $order,
            status: $this->statusRepository->getPaidStatus()
        );

        return [
            'status' => 'success',
            'message' => "order payed success",
            'order_id' => $order->getKey()
        ];
    }
}
