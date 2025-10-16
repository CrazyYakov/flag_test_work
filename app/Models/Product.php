<?php

namespace App\Models;

use App\Models\Pivot\ProductInCart;
use App\Models\Pivot\ReservedProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property float $price
 * @property null|ReservedProduct $reservedProduct
 * @property null|ProductInCart $productInCart
 */
class Product extends Model
{
    use HasFactory;
}
