<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $table = 'galleries_items';

    protected $fillable = [
        'gallery_id',
        'title',
        'path',
        'created_by',
        'updated_by'
    ];

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
