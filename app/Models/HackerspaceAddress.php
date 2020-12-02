<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HackerspaceAddress extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'hackerspace_id',
        'address_id',
        'created_by',
        'updated_by'
    ];

    public function hackerspace() {
        return $this->belongsTo(Hackerspace::class);
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
