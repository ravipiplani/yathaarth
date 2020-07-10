<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

    public function variations() {
        return $this->hasMany(ProductVariation::class);
    }
}
