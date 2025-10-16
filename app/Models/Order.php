<?php

namespace App\Models;

use App\Models\Pivot\ReservedProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;

/**
 * @property string $url
 * @property OrderStatusEnum $status
 * @property Collection $products
 * @property User $user
 * @property PaymentMethod $paymentMethod
 */
class Order extends Model
{
    protected $hidden = [
        'url'
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'orders_products')
            ->using(ReservedProduct::class)
            ->as('reservedProduct')
            ->withTimestamps()
            ->withPivot([
                'count',
                'price'
            ]);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
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
        $this->full_price = $cart->products->sum(fn(Product $product) => $product->productInCart->price);
        $this->count_products = $cart->products->sum(fn(Product $product) => $product->productInCart->count);



        return $this;
    }
}
