<?php

declare(strict_types=1);

namespace Tests\Feature\Cart\Presentation;

use Tests\TestCase;

class IndexProductCartControllerTest extends TestCase
{
    public function testSuccessResponse(): void
    {
        $user = $this->getRandomUser();

        $token = $user->createToken('test_api')->plainTextToken;

        $this->withToken($token)
            ->getJson('/api/cart')
            ->assertOk();
    }
}
