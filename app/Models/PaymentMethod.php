<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Marketplace\Payment\Core\Ports\PaymentMethodContract;

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

    public function getClass(): PaymentMethodContract
    {
        return app($this->class);
    }
}
