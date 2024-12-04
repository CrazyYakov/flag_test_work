<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
namespace Api;

use App\Models\Product;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_index(): void
    {
        $this->getRandomProduct();

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

    public function test_show()
    {
        $product = $this->getRandomProduct();

        $response = $this->get('/api/products/' . $product->getKey());

        $response->assertOk();
    }
}
