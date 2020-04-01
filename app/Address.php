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

    public function state() {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function district() {
        return $this->hasOne(District::class, 'id', 'district_id');
    }
}
