<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array'
    ];

    public function addressable() {
        return $this->morphTo();
    }
}
