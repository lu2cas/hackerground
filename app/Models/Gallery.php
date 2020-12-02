<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'created_by',
        'updated_by'
    ];

    public function hackerspace() {
        return $this->hasOne(HackerspaceGallery::class);
    }

    public function event() {
        return $this->hasOne(EventGallery::class);
    }

    public function project() {
        return $this->hasOne(ProjectGallery::class);
    }

    public function galleryItems() {
        return $this->hasMany(GalleryItem::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
