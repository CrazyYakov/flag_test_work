<?php

namespace App\Models;

use App\Models\Pivot\ProductInCart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $user_id
 *
 * @property-read  User $user
 * @property-read  Collection|Product[] $products
 */
class Cart extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'carts_products')
            ->using(ProductInCart::class)
            ->as('productInCart')
            ->withTimestamps()
            ->withPivot([
                'count',
                'price'
            ]);
    }
}
