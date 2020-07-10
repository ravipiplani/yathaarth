<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $guarded = ['id'];

    protected $appends = [
        'display_name'
    ];

    protected $casts = [
        'unit_price' => 'array',
        'box_price' => 'array'
    ];

    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getDisplayNameAttribute($value) {
        return $this->product->name.' - '.$this->weight.'g';
    }

    public function priceFor($type) {
        return $this->box_price[$type];
    }
}
