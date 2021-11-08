<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAllocation extends Model
{
    use HasFactory;

    public function userLeaveAllocaiton()
    {
        return $this->belongsTo(User::class);
    }
}
