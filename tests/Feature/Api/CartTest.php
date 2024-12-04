<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
namespace Api;

use App\Models\Product;
use App\Models\User;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use Tests\TestCase;

class CartTest extends TestCase
{
    private CartRepositoryInterface $cartRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cartRepository = app(CartRepositoryInterface::class);
    }

    public function test_index()
    {
        $user = $this->getRandomUser();

        $token = $user->createToken('test_api')->plainTextToken;

        $this->withToken($token);

        $this->get('/api/cart')->assertOk();
    }

    public function test_store(): void
    {
        $product = $this->getRandomProduct();

        $user = $this->getRandomUser();

        $token = $user->createToken('test_api')->plainTextToken;

        $this->withToken($token);

        $response = $this->postJson('/api/cart/' . $product->getKey());

        $response->assertStatus(200);
    }

    public function test_remove()
    {
        $product = $this->getRandomProduct();

        $user = $this->getRandomUser();

        $this->cartRepository->storeProductInCart($user->cart, $product);

        $token = $user->createToken('test_api')->plainTextToken;

        $products = $this->cartRepository->getProducts($user->cart)->random();

        $this->withToken($token);

        $this->delete('/api/cart/' . $products->getKey())->assertOk();
    }

    private function mapProduct(Product $product)
    {
        return [
            'id' => $product->getKey(),
            'price' => $product->productInCart->price,
            'count' => $product->productInCart->count
        ];
    }
}
