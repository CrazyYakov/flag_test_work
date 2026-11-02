<?php

namespace Marketplace\Order\Infrastructure\Repositories;

use App\Models\Order as OrderModel;
use App\Models\Product as ProductModel;
use Illuminate\Database\Eloquent\Collection;
use Marketplace\Order\Core\Domain\Aggregates\Order;
use Marketplace\Order\Core\Domain\Entities\Product;
use Marketplace\Order\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Order\Core\Domain\Values\List\OrderList;
use Marketplace\Order\Core\Domain\Values\List\ProductList;
use Marketplace\Order\Core\Ports\FilterContract;
use Marketplace\Order\Core\Ports\OrderRepositoryContract;
use Marketplace\Order\Core\Ports\SorterContract;

class OrderRepository implements OrderRepositoryContract
{
    public function get(FilterContract $filter, SorterContract $sorter): OrderList
    {
        $query = OrderModel::query();

        $query = $filter->apply($query);

        $query = $sorter->apply($query);

        /** @var Collection<int, OrderModel> $orderModels */
        $orderModels = $query->get();

        $orders = $orderModels
            ->map(fn(OrderModel $order) => $this->makeOrder($order))
            ->all();

        return new OrderList($orders);
    }

    public function getById(int $id): Order
    {
        $model = OrderModel::query()
            ->findOrFail($id);

        return $this->makeOrder($model);
    }

    public function getLastOrder(int $userId): ?Order
    {
        $model = OrderModel::query()
            ->where('user_id', $userId)
            ->latest()
            ->first();

        return transform(
            $model,
            fn(OrderModel $order) => $this->makeOrder($order)
        );
    }

    protected function makeOrder(OrderModel $model): Order
    {
        /** @var Collection<int, ProductModel> $productModels */
        $productModels = $model->products()->get();

        $productList = new ProductList(
            $productModels
                ->map(fn(ProductModel $product) => new Product(
                    (string) $product->id,
                    $product->title,
                    $product->reservedProduct->price ?? 0.0,
                    $product->reservedProduct->count ?? 0,
                ))
                ->all()
        );

        return new Order(
            $model->id,
            $productList,
            $model->status,
            PaymentMethodEnum::from($model->paymentMethod->slug),
            $model->url,
        );
    }
}
