<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProjects extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_projects';

    protected $fillable = [
        'user_id', 'project_id', 'status'
    ];

    public function projectMembers()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function projectList()
    {
        return $this->hasMany(Project::class, 'id', 'project_id');
    }
}
