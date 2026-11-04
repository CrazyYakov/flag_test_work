<?php

namespace Marketplace\Product\Infrastructure\Repositories;

use App\Models\Product as ProductModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Marketplace\Product\Core\Domain\Entities\Product;
use Marketplace\Product\Core\Domain\Factories\ProductFactory;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;
use Marketplace\Product\Core\Ports\FilterContract;
use Marketplace\Product\Core\Ports\ProductRepositoryContract;
use Marketplace\Product\Core\Ports\SorterContract;
use Meilisearch\Endpoints\Indexes;

class ProductRepository implements ProductRepositoryContract
{
    public function __construct(
        private ProductFactory $productFactory,
    ) {}

    public function getById(int $id): Product
    {
        $model = ProductModel::query()->findOrFail($id);

        return $this->productFactory->create($model->toArray());
    }

    public function get(FilterContract $filter, SorterContract $sorter): ProductList
    {
        $builder = ProductModel::search('', function (Indexes $meiliSearch, string $query, array $options) use ($filter, $sorter) {
            $options = array_merge($options, $filter->apply(), $sorter->apply());

            if ($search = Arr::pull($options, 'search')) {
                $query = $search;
            }

            return $meiliSearch->search($query, $options);
        });

        /** @var Collection<int, ProductModel> $productModels */
        $productModels = $builder->get();

        return new ProductList(
            $productModels
                ->map(fn(ProductModel $model) => $this->productFactory->create($model->toArray()))
                ->all()
        );
    }
}
