<?php

namespace Marketplace\Order\Infrastructure\Repositories;

use App\Models\Order as OrderModel;
use App\Models\Product as ProductModel;
use Marketplace\Order\Core\Domain\Aggregates\Order;
use Marketplace\Order\Core\Domain\Entities\Product;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;
use Marketplace\Order\Core\Domain\Values\Enums\PaymentMethodEnum;
use Marketplace\Order\Core\Domain\Values\List\OrderList;
use Marketplace\Order\Core\Domain\Values\List\ProductList;
use Marketplace\Order\Infrastructure\Interfaces\FilterInterface;
use Marketplace\Order\Infrastructure\Interfaces\OrderRepositoryInterface;
use Marketplace\Order\Infrastructure\Interfaces\SorterInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function get(FilterInterface $filter, SorterInterface $sorter): OrderList
    {
        $query = OrderModel::query();

        $query = $filter->apply($query);

        $query = $sorter->apply($query);

        $orders = $query->get()
            ->map(fn (OrderModel $order) => $this->makeOrder($order))
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
        $productList = new ProductList(
            $model->products()
                ->get()
                ->map(fn(ProductModel $product) => new Product(
                    $product->id,
                    $product->title,
                    $product->reservedProduct->price,
                    $product->reservedProduct->count,
                ))
                ->all()
        );

        return new Order(
            $model->id,
            $productList,
            OrderStatusEnum::from($model->status->slug),
            PaymentMethodEnum::from($model->paymentMethod->slug),
            $model->url,
        );
    }
}
