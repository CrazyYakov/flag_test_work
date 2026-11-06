<?php

declare(strict_types=1);

namespace Tests\Feature\Order\Presentation\Controllers;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Tests\TestCase;

class IndexOrderControllerTest extends TestCase
{
    private const VALID_QUERY = [
        'filter_status' => OrderStatusEnum::ON_PAYMENT->value,
        'sort_created_at' => 'desc',
    ];

    public function testUnauthorizedWithoutToken(): void
    {
        $this->getJson('/api/orders' . '?' . http_build_query(self::VALID_QUERY))
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Unauthenticated.');
    }

    public function testSuccessResponseWithOrderStructure(): void
    {
        $user = $this->getRandomUser();

        $firstProduct = $this->getRandomProduct();
        $secondProduct = $this->getRandomProduct();

        $order = $this->createOrder($user, OrderStatusEnum::ON_PAYMENT, [
            [$firstProduct, 2, 999.99],
            [$secondProduct, 1, 500.00],
        ]);

        $response = $this->withToken($user->createToken('test_api')->plainTextToken)
            ->getJson('/api/orders?' . http_build_query([
                'filter_status' => OrderStatusEnum::ON_PAYMENT->value,
                'sort_created_at' => 'desc',
            ]))
            ->assertOk();

        $response
            ->assertJsonPath('data.0.id', $order->getKey())
            ->assertJsonPath('data.0.full_price', 2499.98)
            ->assertJsonPath('data.0.count', 3)
            ->assertJsonCount(1, 'data')
            ->assertJsonCount(2, 'data.0.products')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'full_price',
                        'count',
                        'products' => [
                            '*' => ['id', 'title', 'price', 'quantity'],
                        ],
                    ],
                ],
            ]);

        // Порядок резервов в заказе реализацией не гарантируется, поэтому сверяем множества id.
        $reservedIds = array_map('intval', $response->json('data.0.products.*.id'));
        sort($reservedIds);

        $this->assertSame(
            [$firstProduct->getKey(), $secondProduct->getKey()],
            $reservedIds,
        );
    }

    public function testFilterByStatusReturnsOnlyMatchingOrders(): void
    {
        $user = $this->getRandomUser();

        $onPayment = $this->createOrder($user, OrderStatusEnum::ON_PAYMENT);
        $paid = $this->createOrder($user, OrderStatusEnum::PAID);
        $canceled = $this->createOrder($user, OrderStatusEnum::CANCELED);

        $token = $user->createToken('test_api')->plainTextToken;

        $this->withToken($token)
            ->getJson('/api/orders?' . http_build_query([
                'filter_status' => OrderStatusEnum::PAID->value,
                'sort_created_at' => 'asc',
            ]))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $paid->getKey());

        $this->assertSame(
            [$onPayment->getKey()],
            $this->orderIds($token, OrderStatusEnum::ON_PAYMENT),
        );

        $this->assertSame(
            [$canceled->getKey()],
            $this->orderIds($token, OrderStatusEnum::CANCELED),
        );
    }

    public function testSortingByCreatedAt(): void
    {
        $user = $this->getRandomUser();

        $first = $this->createOrder($user, OrderStatusEnum::ON_PAYMENT, createdAt: Carbon::parse('2025-01-01 10:00:00'));
        $second = $this->createOrder($user, OrderStatusEnum::ON_PAYMENT, createdAt: Carbon::parse('2025-01-02 10:00:00'));
        $third = $this->createOrder($user, OrderStatusEnum::ON_PAYMENT, createdAt: Carbon::parse('2025-01-03 10:00:00'));

        $token = $user->createToken('test_api')->plainTextToken;

        $this->withToken($token)
            ->getJson('/api/orders?' . http_build_query([
                'filter_status' => OrderStatusEnum::ON_PAYMENT->value,
                'sort_created_at' => 'asc',
            ]))
            ->assertOk()
            ->assertJsonPath('data.0.id', $first->getKey())
            ->assertJsonPath('data.1.id', $second->getKey())
            ->assertJsonPath('data.2.id', $third->getKey());

        $this->withToken($token)
            ->getJson('/api/orders?' . http_build_query([
                'filter_status' => OrderStatusEnum::ON_PAYMENT->value,
                'sort_created_at' => 'desc',
            ]))
            ->assertOk()
            ->assertJsonPath('data.0.id', $third->getKey())
            ->assertJsonPath('data.2.id', $first->getKey());
    }

    public function testFilterStatusValidationFailed(): void
    {
        $user = $this->getRandomUser();

        $this->withToken($user->createToken('test_api')->plainTextToken)
            ->getJson('/api/orders?' . http_build_query([
                'filter_status' => 'not-an-integer',
                'sort_created_at' => 'desc',
            ]))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['filter_status']);
    }

    /**
     * @param list<array{0: Product, 1: int, 2: float}> $products
     */
    private function createOrder(
        User $user,
        OrderStatusEnum $status,
        array $products = [],
        ?Carbon $createdAt = null,
    ): Order {
        $paymentMethod = PaymentMethod::query()
            ->firstOrCreate(
                ['slug' => 'alpha_bank'],
                [
                    'title' => 'Alpha Bank',
                    'class' => 'Marketplace\Payment\Infrastructure\Services\Banks\AlphaBank',
                ],
            );

        $order = new Order();
        $order->status = $status;
        $order->user_id = $user->getKey();
        $order->payment_method_id = $paymentMethod->getKey();
        $order->url = 'https://example.test/orders/pay';

        if ($createdAt !== null) {
            $order->created_at = $createdAt;
            $order->updated_at = $createdAt;
        }

        $order->save();

        if ($products === []) {
            $products = [[$this->getRandomProduct(), 1, 100.0]];
        }

        foreach ($products as [$product, $count, $price]) {
            $order->products()->attach($product, [
                'count' => $count,
                'price' => $price,
            ]);
        }

        return $order;
    }

    /** @return list<int> */
    private function orderIds(string $token, OrderStatusEnum $status): array
    {
        return $this->withToken($token)
            ->getJson('/api/orders?' . http_build_query([
                'filter_status' => $status->value,
                'sort_created_at' => 'asc',
            ]))
            ->json('data.*.id');
    }
}
