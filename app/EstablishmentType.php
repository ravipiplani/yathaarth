<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablishmentType extends Model
{
    protected $guarded = ['id'];

    public function establishment() {
        return $this->belongsTo(Establishment::class);
    }
}
