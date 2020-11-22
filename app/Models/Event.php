<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'url',
        'activity',
        'starts_at',
        'ends_at',
        'summary',
        'hackerspace_id',
        'created_by',
        'updated_by'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function hackerspace() {
        return $this->belongsTo(Hackerspace::class);
    }
}
