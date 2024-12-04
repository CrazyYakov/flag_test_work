<?php

namespace Api;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    public function test_index()
    {
        $this->get('/api/payment/methods')->assertOk();
    }
}
