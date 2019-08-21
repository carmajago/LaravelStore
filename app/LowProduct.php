<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LowProduct extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'possible_low_rate',
        'product_id',
        'type'
    ];
}
