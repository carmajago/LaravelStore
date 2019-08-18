<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    protected $fillable = [
        'total_credit', 'total_counted', 'client_id', 'user_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
