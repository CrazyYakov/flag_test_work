<?php

declare(strict_types=1);

namespace Tests\Feature\Product\Presentation\Controllers;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Marketplace\Product\Core\Ports\FilterContract;
use Marketplace\Product\Core\Ports\ProductRepositoryContract;
use Marketplace\Product\Core\Ports\SorterContract;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class IndexProductControllerTest extends TestCase
{
    public function testSuccessResponse(): void
    {
        Product::factory(10)->create();

        $uri = '/api/products';

        $this->get($uri)->assertStatus(200);

        $this
            ->get($uri)
            ->assertStatus(200);
    }

    public function testSearchSuccessResponse(): void
    {
        $expectedProductList = $this->createMockProductList();

        /** @var MockInterface|ProductRepositoryContract $productRepository */
        $productRepository = Mockery::mock(ProductRepositoryContract::class);

        $search = 'Laptop';

        $productRepository
            ->shouldReceive('get')
            ->once()
            ->withArgs(function (FilterContract $filter, SorterContract $sorter) use ($search) {
                $this->assertSame(
                    [
                        'attributesToSearchOn' => [
                            'price',
                            'title',
                        ],
                        'search' => $search,
                    ],
                    $filter->apply()
                );

                $this->assertSame([], $sorter->apply());

                return true;
            })
            ->andReturn($expectedProductList);

        $this->instance(ProductRepositoryContract::class, $productRepository);

        $uri = '/api/products?search=' . $search;

        $this->get($uri)->assertStatus(200);
    }

    public function testFilterPriceSuccessResponse(): void
    {
        $productRepository = Mockery::mock(ProductRepositoryContract::class);

        $expectedPrice = 1000.0;

        $productRepository
            ->shouldReceive('get')
            ->once()
            ->withArgs(function (FilterContract $filter, SorterContract $sorter) use ($expectedPrice) {
                $this->assertSame(
                    [
                        'attributesToSearchOn' => [
                            'price',
                            'title',
                        ],
                        'filter' => [
                            'price = ' . $expectedPrice,
                        ],
                    ],
                    $filter->apply()
                );

                $this->assertSame([], $sorter->apply());

                return true;
            })
            ->andReturn(new ProductList([]));

        $this->instance(ProductRepositoryContract::class, $productRepository);

        $uri = '/api/products?filter_price=' . $expectedPrice;

        $this->get($uri)->assertStatus(200);
    }

    public function testSortPriceDescSuccessResponse(): void
    {
        $productRepository = Mockery::mock(ProductRepositoryContract::class);

        $productRepository
            ->shouldReceive('get')
            ->once()
            ->withArgs(function (FilterContract $filter, SorterContract $sorter) {
                $this->assertSame(
                    [
                        'attributesToSearchOn' => [
                            'price',
                            'title',
                        ],
                    ],
                    $filter->apply()
                );

                $this->assertSame(
                    [
                        'sort' => [
                            'price:desc',
                        ],
                    ],
                    $sorter->apply()
                );

                return true;
            })
            ->andReturn(new ProductList([]));

        $this->instance(ProductRepositoryContract::class, $productRepository);

        $uri = '/api/products?sort_price_dir=desc';

        $this->get($uri)->assertStatus(200);
    }

    private function createMockProductList(): ProductList
    {
        return new ProductList([]);
    }
}
