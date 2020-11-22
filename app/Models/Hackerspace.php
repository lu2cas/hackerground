<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hackerspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'geolocation',
        'logo_path',
        'founded_on',
        'status',
        'website',
        'email',
        'created_by',
        'updated_by'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->hasMany(Event::class);
    }
}
