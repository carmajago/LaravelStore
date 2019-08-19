<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesReturnDetail extends Model
{
    protected $fillable = [
        'product_quantity', 'sales_return_id', 'product_id'
    ];
}
