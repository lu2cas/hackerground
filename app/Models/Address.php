<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'state',
        'city',
        'street',
        'number',
        'complement',
        'zip_code',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function user() {
        return $this->belongsToMany(User::class)
                    ->using(UserAddress::class)
                    ->withPivot('created_by', 'updated_by')
                    ->withTimestamps();
    }

    public function hackerspace() {
        return $this->belongsToMany(Hackerspace::class)
                    ->using(HackerspaceAddress::class)
                    ->withPivot('created_by', 'updated_by')
                    ->withTimestamps();
    }

    public function event() {
        return $this->belongsToMany(Event::class)
                    ->using(EventAddress::class)
                    ->withPivot('created_by', 'updated_by')
                    ->withTimestamps();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
