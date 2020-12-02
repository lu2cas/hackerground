<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressMention extends Model
{
    use HasFactory;

    protected $fillable = [
        'hackerspace_id',
        'title',
        'excerpt',
        'published_on',
        'url',
        'created_by',
        'updated_by',
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
