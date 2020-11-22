<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressMention extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'published_on',
        'url',
        'created_by',
        'updated_by',
        'hackerspace_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function hackerspace() {
        return $this->belongsTo(Hackerspace::class);
    }
}
