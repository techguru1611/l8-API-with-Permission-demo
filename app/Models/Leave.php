<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_from',
        'request_to',
        'type',
        'halfday_status',
        'start_date',
        'end_date',
        'return_date',
        'duration',
        'reason',
        'isadhoc_leave',
        'adhoc_status',
        'available_on_phone',
        'available_on_city',
        'emergency_contact',
        'status',
        'approved_by',
        'rejected_by',
    ];

    public function userLeave()
    {
        return $this->belongsTo(User::class, 'request_from', 'id');
    }

    public function requestfromLeave()
    {
        return $this->belongsTo(User::class, 'request_to', 'id');
    }

    /**
     * Mutators for change date format at the time of store value
     *
     * @param [date] $value
     * @return void
     * @date 10-09-2021 
     * @author Ravi Chauhan <ravichauhan.inexture@gmail.com> 
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
     * @param [date] $value
     * @return date
     * @date 10-09-2021 
     * @author Ravi Chauhan <ravichauhan.inexture@gmail.com> 
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
