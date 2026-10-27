<?php

namespace Marketplace\Product\Infrastructure\Repositories;

use App\Models\Product as ProductModel;
use Marketplace\Product\Core\Domain\Entities\Product;
use Marketplace\Product\Core\Domain\Factories\ProductFactory;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;
use Marketplace\Product\Core\Ports\FilterContract;
use Marketplace\Product\Core\Ports\ProductRepositoryContract;
use Marketplace\Product\Core\Ports\SorterContract;

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
        $builder = ProductModel::query();

        $builder = $filter->apply($builder);

        $builder = $sorter->apply($builder);

        return new ProductList(
            $builder->get()
                ->map(fn (ProductModel $model) => $this->productFactory->create($model->toArray()))
                ->all()
        );
    }
}
