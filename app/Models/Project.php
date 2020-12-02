<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'hackerspace_id',
        'title',
        'description',
        'started_on',
        'ended_on',
        'status',
        'category',
        'repository',
        'created_by',
        'updated_by'
    ];

    public function hackerspace() {
        return $this->belongsTo(Hackerspace::class);
    }

    public function gallery() {
        return $this->belongsToMany(Gallery::class)
                    ->using(ProjectGallery::class)->withTimestamps()
                    ->withPivot('created_by', 'updated_by')
                    ->withTimestamps();
    }

    public function projectUpdate() {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
