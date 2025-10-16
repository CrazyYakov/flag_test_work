<?php


namespace Tests\Feature\Product\Presentation\Controllers;

use App\Models\Product;
use Illuminate\Support\Arr;
use Tests\TestCase;

class IndexProductControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testSuccessResponse(): void
    {
        Product::factory(10)->create();

        $uri = '/api/products';

        $this->get($uri)->assertStatus(200);

        $params = [
            'sort_price' => 'asc',
        ];

        $response = $this
            ->get($uri . '?' . http_build_query($params), $params)
            ->assertStatus(200);

        $products = $response->json('data');

        $sortProducts = Arr::sort($products, 'price');

        $this->assertEquals($products, $sortProducts);
    }
}
