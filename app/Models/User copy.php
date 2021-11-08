<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'role_id',
        'user_name',
        'profile_image',
        'email',
        'personal_email',
        'password',
        'phone_number',
        'emergency_number',
        'temp_address1',
        'temp_address2',
        'temp_zipcode',
        'temp_contry',
        'temp_state',
        'temp_city',
        'address1',
        'address2',
        'city',
        'state',
        'contry',
        'zipcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [ 'deleted_at', 'wedding_anniversary' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name', 'full_address', 'profile_picture'];

    public function getFullNameAttribute()
    {
        $full_name =  $this->first_name;
        if(!empty($this->last_name)) {

            $full_name .=  ' ' . $this->last_name;
        }
        return $full_name;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = Helper::setDateFormat($value);
    }

    public function setWeddingAnniversaryAttribute($value)
    {
        $this->attributes['wedding_anniversary'] = Helper::setDateFormat($value);
    }

    public function getBirthDateAttribute($value)
    {
        return Helper::getDateFormat($value);
    }

    public function getWeddingAnniversaryAttribute($value)
    {
        return Helper::getDateFormat($value);
    }

    public function temp_cities()
    {
        return $this->belongsTo("App\Models\City",'temp_city');
    }
    public function temp_states()
    {
        return $this->belongsTo("App\Models\State",'temp_state');
    }
    public function temp_country()
    {
        return $this->belongsTo("App\Models\Country",'temp_contry');
    }

    public function cities()
    {
        return $this->belongsTo("App\Models\City",'city');
    }
    public function states()
    {
        return $this->belongsTo("App\Models\State",'state');
    }
    public function country()
    {
        return $this->belongsTo("App\Models\Country",'contry');
    }

    public function getTempFullAddressAttribute()
    {
        $country = ($this->temp_contry) ? $this->temp_country->name : '';
        $state = ($this->temp_state) ? $this->temp_states->name : '';
        $city = ($this->temp_city) ? $this->temp_cities->name : '';
        $full_address  = implode(", ", array_filter([$this->temp_address1, $city, $state, $country]));
        return $full_address;
    }

    public function getFullAddressAttribute()
    {
        $country = ($this->contry) ? $this->country->name : '';
        $state = ($this->state) ? $this->states->name : '';
        $city = ($this->city) ? $this->cities->name : '';
        $full_address  = implode(", ",array_filter([$this->address1,$this->address2,$city,$state,$country,$this->zipcode]));
        return $full_address;
    }

    public function userRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function officialUser()
    {
        return $this->belongsTo(UserOfficialDetail::class, 'id', 'user_id');
    }

    public function userEducation()
    {
        return $this->hasMany(UserEducation::class, 'user_id');
    }

    public function userExperience()
    {
        return $this->hasMany(UserExperience::class, 'user_id');
    }

    public function userBank()
    {
        return $this->hasOne(UserBank::class, 'user_id');
    }

    public function userFamily()
    {
        return $this->hasMany(UserFamily::class,  'user_id');
    }

    public function userDailyTask()
    {
        return $this->hasMany(DailyTask::class, 'user_id', 'id');
    }

    public function userProjects()
    {
        return $this->hasMany(UserProjects::class, 'user_id', 'id');
    }

    public function getProfilePictureAttribute()
    {
        $first_name = $this->first_name;
        $last_name = $this->last_name;
        if (!isset($last_name)) {
            $initials = $first_name[0] . $first_name[1];
        } else {
            $initials = $first_name[0] . $last_name[0];
        }

        return strtoupper($initials);
    }
}

User::deleting(function ($user) {
    $user->officialUser()->delete();
    $user->userEducation()->delete();
    $user->userExperience()->delete();
    $user->userBank()->delete();
    $user->userFamily()->delete();
});
