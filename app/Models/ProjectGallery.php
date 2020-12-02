<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectGallery extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'gallery_id',
        'created_by',
        'updated_by'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
