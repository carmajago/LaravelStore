<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'iva',
        'quantity_available',
        'minimum_quantity',
        'maximum_quantity',
        'product_presentation_id',
        'product_category_id',
        'expiration'
    ];
}
