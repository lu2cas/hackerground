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
        return $this->belongsToMany(Hackerspace::class)
            ->using(HackerspaceGallery::class)
            ->withPivot('created_by', 'updated_by')
            ->withTimestamps();
    }

    public function event() {
        return $this->belongsToMany(Event::class)
            ->using(EventGallery::class)
            ->withPivot('created_by', 'updated_by')
            ->withTimestamps();
    }

    public function project() {
        return $this->belongsToMany(Project::class)
            ->using(ProjectGallery::class)
            ->withPivot('created_by', 'updated_by')
            ->withTimestamps();
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
