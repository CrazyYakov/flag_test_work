<?php

namespace App\Models;

use App\Builders\OrderBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property string $url
 * @property float $full_price
 * @property int $count_products
 * @property Status $status
 * @property Collection $products
 * @property User $user
 * @property PaymentMethod $paymentMethod
 */
class Order extends Model
{
    protected static string $builder = OrderBuilder::class;

    protected $hidden = [
        'url'
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

    public function setStatus(Status $status): static
    {
        $this->status()->associate($status);

        return $this;
    }

    public function setProductInCart(Cart $cart): static
    {
        $this->full_price = $cart->products->sum(fn(Product $product) => $product->productInCart->price);
        $this->count_products = $cart->products->sum(fn(Product $product) => $product->productInCart->count);

        $this->products()->sync($cart->products->keyBy('id')->map(function (Product $product) {
            return [
                'price' => $product->productInCart->price,
                'count' => $product->productInCart->count
            ];
        }));

        $this->save();

        return $this;
    }
}
