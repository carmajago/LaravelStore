<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderPayment extends Model
{

    protected $fillable = [
        'value', 'provider_id'
    ];
}
