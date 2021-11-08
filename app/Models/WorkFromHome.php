<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WorkFromHome extends Model
{
    use HasFactory;

    protected $table = 'wfh_requests';

    protected $fillable = [
        'user_id',
        'request_to',
        'start_date',
        'end_date',
        'wfh_type',
        'halfday_status',
        'return_date',
        'duration',
        'status',
        'approved_by',
        'rejected_by',
        'reason',
    ];

    public function userWfh()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function requestfromWfh()
    {
        return $this->belongsTo(User::class, 'request_to', 'id');
    }

    /**
     * Accessors methods for change date format
     *
     * @param [type] $value
     * @return void
     * @date 05-10-2021 
     * @author Nidhi Patel <nidhi.inexture@gmail.com> 
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setReturnDateAttribute($value)
    {
        $this->attributes['return_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Accessors methods for change date format
     *
     * @param [type] $value
     * @return void
     * @date 05-10-2021 
     * @author Nidhi Patel <nidhi.inexture@gmail.com> 
     */
    public function getStartDateAttribute($value)
    {
        if ($value == null || $value == '0000-00-00') {
            return '';
        }
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getEndDateAttribute($value)
    {
        if ($value == null || $value == '0000-00-00') {
            return '';
        }
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getReturnDateAttribute($value)
    {
        if ($value == null || $value == '0000-00-00') {
            return '';
        }
        return Carbon::parse($value)->format('d-m-Y');
    }
}
