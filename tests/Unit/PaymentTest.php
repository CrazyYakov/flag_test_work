<?php

namespace Tests\Unit;

use Marketplace\Payment\Infrastructure\Services\TokenService;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_jwtToken(): void
    {
        $payload = [
            'hello' => 'world'
        ];

        $payment = new TokenService(
            'test-token',
            'test-algorithm',
        );

        $token = $payment->encodeToken($payload);

        $payloadFromToken = $payment->decodeToken($token);

        $this->assertEquals($payload, $payloadFromToken);
    }
}
