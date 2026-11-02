<?php

namespace App\Models;

use App\Models\Pivot\ReservedProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;

/**
 * @property string $url
 * @property OrderStatusEnum $status
 * @property Collection<int, Product> $products
 * @property User $user
 * @property PaymentMethod $paymentMethod
 * @property float $full_price
 * @property int $count_products
 */
class Order extends Model
{
    protected $hidden = [
        'url',
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<PaymentMethod, $this> */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /** @return BelongsToMany<Product, $this> */
    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'orders_products')
            ->using(ReservedProduct::class)
            ->as('reservedProduct')
            ->withTimestamps()
            ->withPivot([
                'count',
                'price',
            ]);
    }

    public function setUser(User $user): static
    {
        $this->user()->associate($user);

        return $this;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): static
    {
        $this->paymentMethod()->associate($paymentMethod);

        return $this;
    }

    public function setProductInCart(Cart $cart): static
    {
        $this->full_price = (float) $cart->products->sum(fn(Product $product) => $product->productInCart->price ?? 0);
        $this->count_products = (int) $cart->products->sum(fn(Product $product) => $product->productInCart->count ?? 0);

        return $this;
    }
}
