<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technology extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'technology';

    protected $fillable = [
        'technology', 'description', 'status'
    ];

    public function projectTechnology()
    {
        return $this->hasOne(Project::class);
    }

}
