<?php

namespace Tests\Unit;

use App\Services\Payments\Payment;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Payment::setTokenKey(123);
        Payment::setAlg("HS256");
    }

    /**
     * A basic test example.
     */
    public function test_jwtToken(): void
    {
        $payload = [
            'hello' => 'world'
        ];

        $token = Payment::encodeToken($payload);

        $payloadFromToken = (array) Payment::decodeToken($token);

        $this->assertEquals($payload, $payloadFromToken);
    }
}
