<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'address', 'phone','credit'
    ];

    public function scopeFindName($query, $name = null)
    {
        if ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        }
        return $query;
    }
}
