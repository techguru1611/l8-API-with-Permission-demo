<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_code',
        'project_type',
        'payment_type_id',
        'client_id',
        'amount',
        'currency',
        'allocation_id',
        'priority_id',
        'status',
        'team_lead_id',
        'reviewer_id',
        'technologies_ids',
        'members_ids'
    ];

    public function projectClient()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function projectAllocation()
    {
        return $this->belongsTo(ProjectAllocation::class, 'allocation_id', 'id');
    }

    public function projectTeamLead()
    {
        return $this->belongsTo(User::class, 'team_lead_id', 'id');
    }

    public function projectReviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id', 'id');
    }

    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'status', 'id');
    }

    public function projectPriority()
    {
        return $this->belongsTo(ProjectPriority::class, 'priority_id', 'id');
    }

    public function projectPaymentType()
    {
        return $this->belongsTo(ProjectPaymentType::class, 'payment_type_id', 'id');
    }

    public function projectTechnology()
    {
        return $this->belongsToMany(Technology::class,'project_technology','project_id','technology_id');
    }
}
