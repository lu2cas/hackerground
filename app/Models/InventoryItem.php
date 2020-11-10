<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'created_by',
        'updated_by',
        'hackerspace_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }
}
