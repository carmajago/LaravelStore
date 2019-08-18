<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = [
        'quantity', 'price', 'iva', 'discount', 'sale_id', 'product_id'
    ];
}
