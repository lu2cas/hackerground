<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    use HasFactory;

    protected $table = 'projects_updates';

    protected $fillable = [
        'project_id',
        'title',
        'body',
        'created_by',
        'updated_by'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
