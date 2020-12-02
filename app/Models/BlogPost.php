<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'hackerspace_id',
        'title',
        'excerpt',
        'body',
        'slug',
        'created_by',
        'updated_by'
    ];

    public function hackerspace() {
        return $this->belongsTo(Hackerspace::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
