<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Marketplace\Payment\Infrastructure\Interfaces\PaymentMethodInterface;

/**
 * @property string $title
 * @property string $slug
 * @property string $class
 */
class PaymentMethod extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'class'
    ];

    protected $hidden = [
        'class'
    ];

    public $timestamps = false;

    public function getClass(): PaymentMethodInterface
    {
        return app($this->class);
    }
}
