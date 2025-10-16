<?php

declare(strict_types=1);

namespace Tests\Feature\Product\Presentation\Controllers;

use Tests\TestCase;

class ShowProductControllerTest extends TestCase
{
    public function testSuccessResponse(): void
    {
        $product = $this->getRandomProduct();

        $response = $this->get('/api/products/' . $product->getKey());

        $response->assertOk();
    }
}
