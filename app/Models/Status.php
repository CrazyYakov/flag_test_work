<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $slug
 */
class Status extends Model
{
    public $timestamps = false;

    protected $hidden = [
       'slug'
    ];
}
