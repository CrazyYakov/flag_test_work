<?php

declare(strict_types=1);

namespace Tests\Feature\Payment\Presentation;

use Tests\TestCase;

class IndexPaymentMethodControllerTest extends TestCase
{
    public function testSuccessResponse(): void
    {
        $this->get('/api/payment/methods')
            ->assertOk();
    }
}
