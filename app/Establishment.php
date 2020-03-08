<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected  $dates = [
        'deleted_at',
        'registration_date'
    ];

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function scopeRegistered($query) {
        return $query->where('is_registered', true);
    }

    public function scopeOfType($query, $type) {
        return $query->whereHas('type', function($q) use ($type) {
            $q->where('name', $type);
        });
    }

    public function scopeStatusIs($query, $status) {
        return $query->whereHas('status', function($sub_query) use ($status) {
            $sub_query->where('name', $status);
        });
    }

    public function type() {
        return $this->hasOne(EstablishmentType::class, 'id', 'establishment_type_id');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function statuses() {
        return $this->belongsToMany(Status::class)->withPivot('updated_at');
    }

    public function updateStatus($status) {
        $status = Status::where(['name' =>  $status, 'category' => 'ESTABLISHMENT'])->firstOrFail();
        $this->status_id = $status->id;
        $this->save();
        $this->statuses()->attach([$status->id]);
    }

    public function assignee() {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }

    public function addedBy() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function parentEstablishment() {
        return $this->hasOne(__CLASS__, 'id', 'parent_establishment_id');
    }

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function disable() {
        $this->is_active = false;
        $this->save();
    }

    public function enable() {
        $this->is_active = true;
        $this->save();
    }
}
