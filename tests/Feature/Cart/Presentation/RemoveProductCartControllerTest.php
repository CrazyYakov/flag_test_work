<?php

namespace Tests\Feature\Cart\Presentation;

use Tests\TestCase;

class RemoveProductCartControllerTest extends TestCase
{
    public function testBasic()
    {
        $product = $this->getRandomProduct();

        $user = $this->getRandomUser();

        $cart = $user->cart;

        $cart->products()->attach($product, [
            'price' => $product->price,
            'count' => 1
        ]);

        $token = $user->createToken('test_api')->plainTextToken;

        $this->withToken($token);

        $this->delete('/api/cart/' . $product->getKey())->assertOk();

        $this->assertDatabaseMissing('carts_products', [
            'product_id' => $product->getKey(),
            'cart_id' => $cart->getKey(),
        ]);
    }
}
