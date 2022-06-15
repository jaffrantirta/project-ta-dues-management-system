<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'sex',
        'is_active',
        'id_number',
        'date_of_birth',
    ];

    protected $appends = [
        'join',
        'birth',
        'gender',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJoinAttribute()
    {
        return Carbon::create($this->created_at)->isoFormat('Y');
    }

    public function getBirthAttribute()
    {
        return Carbon::create($this->date_of_birth)->isoFormat('D MMM Y');
    }

    public function getGenderAttribute()
    {
        if($this->sex == 'male'){
            return 'Laki -Laki';
        }
        return 'Perempuan';
    }

    public function getProfilePictureAttribute()
    {
        return 'assets/admin/img/'.$this->sex.'.png';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
}
