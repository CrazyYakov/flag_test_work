<?php

namespace Tests\Feature\Cart\Presentation;

use Tests\TestCase;

class StoreProductCartControllerTest extends TestCase
{
    public function testSuccessResponse(): void
    {
        $product = $this->getRandomProduct();

        $user = $this->getRandomUser();

        $token = $user->createToken('test_api')->plainTextToken;

        $this->withToken($token);

        $response = $this->postJson('/api/cart/' . $product->getKey());

        $response->assertStatus(200);
    }
}
