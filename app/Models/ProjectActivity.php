<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'project_id',
        'comments',
    ];

    public function activityUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function activityProject()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
