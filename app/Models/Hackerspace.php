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

    public function address() {
        return $this->belongsToMany(Address::class, 'hackerspaces_addresses')
                    ->using(HackerspaceAddress::class)
                    ->withPivot('created_by', 'updated_by')
                    ->withTimestamps();
    }

    public function gallery() {
        return $this->belongsToMany(Gallery::class)
                    ->using(HackerspaceGallery::class)
                    ->withPivot('created_by', 'updated_by')
                    ->withTimestamps();
    }

    public function event() {
        return $this->hasMany(Event::class);
    }

    public function project() {
        return $this->hasMany(Project::class);
    }

    public function inventoryItem() {
        return $this->hasMany(InventoryItem::class);
    }

    public function pressMention() {
        return $this->hasMany(PressMention::class);
    }

    public function blogPost() {
        return $this->hasMany(BlogPost::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
