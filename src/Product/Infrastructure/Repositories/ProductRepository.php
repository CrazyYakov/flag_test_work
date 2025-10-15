<?php

namespace Marketplace\Product\Infrastructure\Repositories;

use App\Models\Product as ProductModel;
use Marketplace\Product\Core\Domain\Entities\Product;
use Marketplace\Product\Core\Domain\Factories\ProductFactory;
use Marketplace\Product\Core\Domain\Values\Lists\ProductList;
use Marketplace\Product\Infrastructure\Interfaces\FilterInterface;
use Marketplace\Product\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Product\Infrastructure\Interfaces\SorterInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private ProductFactory $productFactory,
    ) {}

    public function getById(int $id): Product
    {
        $model = ProductModel::query()->findOrFail($id);

        return $this->productFactory->create($model->toArray());
    }

    public function get(FilterInterface $filter, SorterInterface $sorter): ProductList
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
