<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HackerspaceGallery extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'hackerspace_id',
        'gallery_id',
        'created_by',
        'updated_by'
    ];

    public function hackerspace() {
        return $this->belongsTo(Hackerspace::class);
    }

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
