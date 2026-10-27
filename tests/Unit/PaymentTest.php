<?php

namespace Tests\Unit;

use Marketplace\Payment\Infrastructure\Services\TokenService;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_jwt_token(): void
    {
        $payload = [
            'hello' => 'world',
        ];

        $payment = new TokenService(
            'test-token',
            'HS256',
        );

        $token = $payment->encodeToken($payload);

        $payloadFromToken = $payment->decodeToken($token);

        $this->assertEquals($payload, (array) $payloadFromToken);
    }
}
