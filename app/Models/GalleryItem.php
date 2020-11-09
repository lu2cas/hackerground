<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $table = 'galleries_items';

    protected $fillable = [
        'title',
        'path',
        'gallery_id',
        'created_by',
        'updated_by'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }
}
