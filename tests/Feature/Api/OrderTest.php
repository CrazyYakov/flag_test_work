<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
namespace Api;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Repositories\Interfaces\StatusRepositoryInterface;
use Tests\TestCase;

class OrderTest extends TestCase
{
    private CartRepositoryInterface $cartRepository;

    private OrderRepositoryInterface $orderRepository;

    private StatusRepositoryInterface $statusRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cartRepository = app(CartRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->statusRepository = app(StatusRepositoryInterface::class);
    }

    public function test_index(): void
    {
        $user = $this->getRandomUser();

        $this->withToken($user->createToken('test_order_store')->plainTextToken);

        $response = $this->get('/api/orders');

        $response->assertStatus(200);
    }

    public function test_storeAndPay()
    {
        $user = $this->getRandomUser();

        $this->cancelLastOrder($user);

        $product = $this->getRandomProduct();
        $cart = $this->cartRepository->getCartByUser($user);

        $this->cartRepository->storeProductInCart($cart, $product);
        $this->cartRepository->storeProductInCart($cart, $product);

        $product = $this->getRandomProduct();

        $this->cartRepository->storeProductInCart($cart, $product);
        $this->cartRepository->storeProductInCart($cart, $product);

        $paymentMethod = PaymentMethod::query()->get()->random();

        $this->withToken($user->createToken('test_order_store')->plainTextToken);

        $response = $this->postJson('/api/orders/create', [
            'data' => [
                'payment_method_id' => $paymentMethod->getKey()
            ]
        ]);

        $response->assertCreated()->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'url',
                'products' => [
                    '*' => [
                        'id',
                        'title',
                        'price',
                        'count'
                    ]
                ]
            ]
        ]);

        $url = $response->json('data.url');

        $orderId = $response->json('data.id');

        $this->assertIsString($url);

        $baseUrl = config('app.url', 'http:://localhost');

        $url = str_replace($baseUrl, '',$url);

        $this->get($url)->assertOk();

        $order = $this->orderRepository->getById($orderId);

        $this->assertTrue($order->status->is($this->statusRepository->getPaidStatus()));

    }

    private function cancelLastOrder(User $user): void
    {
        $cancelledStatus = $this->statusRepository->getCancelledStatus();

        $order = $this->orderRepository->getLastOrder($user);

        if ($order) {
            $this->orderRepository->updateStatus($order, $cancelledStatus);
        }
    }
}
