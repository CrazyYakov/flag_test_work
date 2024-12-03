<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethodResource;
use App\Services\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentMethodController extends Controller
{
    private PaymentMethodRepositoryInterface $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return PaymentMethodResource::collection($this->paymentMethodRepository->all());
    }
}
