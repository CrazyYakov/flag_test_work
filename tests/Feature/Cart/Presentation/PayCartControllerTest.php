<?php

namespace Tests\Feature\Cart\Presentation;

use App\Models\PaymentMethod;
use Database\Seeders\PaymentMethodSeeder;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PayCartControllerTest extends TestCase
{
    #[DataProvider('dataPaymentMethodProvider')]
    public function testBasic(string $paymentMethod): void
    {
        $this->seed(PaymentMethodSeeder::class);

        $product = $this->getRandomProduct();

        $user = $this->getRandomUser();

        $cart = $user->cart;

        $cart->products()->attach($product, [
            'price' => $product->price,
            'count' => 1
        ]);

        $token = $user->createToken('test_api')->plainTextToken;

        $paymentMethodId = PaymentMethod::firstWhere('slug', $paymentMethod)
            ->getKey();

        $this->withToken($token)
            ->postJson('/api/cart/pay/' . $paymentMethodId)
            ->assertOk();

        $this->assertDatabaseMissing('carts', [
            'id' => $cart->id
        ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id
        ]);
    }

    public static function dataPaymentMethodProvider(): array
    {
        return [
            [
                'alpha_bank',
            ],
            [
                'beta_bank'
            ],
        ];
    }
}
