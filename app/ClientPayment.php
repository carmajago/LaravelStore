<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model
{
    protected $fillable = [
        'value', 'client_id', 'name'
    ];
}
