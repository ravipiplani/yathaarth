<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Airlock\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function establishments() {
        return $this->hasMany(Establishment::class, 'assigned_to');
    }

    public function isAssignee($establishment) {
        return $establishment->assigned_to === $this->id;
    }
}
