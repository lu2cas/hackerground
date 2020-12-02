<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'hackerspace_id',
        'title',
        'description',
        'type',
        'url',
        'activity',
        'starts_at',
        'ends_at',
        'summary',
        'created_by',
        'updated_by'
    ];

    public function hackerspace() {
        return $this->belongsTo(Hackerspace::class);
    }

    public function address() {
        return $this->belongsToMany(Address::class)
                    ->using(EventAddress::class)
                    ->withPivot('created_by', 'updated_by')
                    ->withTimestamps();
    }

    public function gallery() {
        return $this->belongsToMany(Gallery::class)
                    ->using(EventGallery::class)
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
