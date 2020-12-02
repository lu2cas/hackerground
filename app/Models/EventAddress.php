<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventAddress extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'address_id',
        'created_by',
        'updated_by'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
