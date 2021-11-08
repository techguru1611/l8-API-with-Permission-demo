<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_lead_id',
        'status'
    ];

    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_lead_id');
    }

    // public function userTeam()
    // {
    //     return $this->hasOne(Team::class,'team_id');
    // }
}
