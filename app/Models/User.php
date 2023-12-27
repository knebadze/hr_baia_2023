<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'user_type_id',
        'name_ka',
        'name_en',
        'name_ru',
        'email',
        'number',
        'date_of_birth',
        'gender_id',
        'avatar',
        'provider',
        'provider_id',
        'provider_token',
        'is_active',
        'status',
        'lang',
        'password',
        'verify_code',
        'verify_code_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setProviderTokenAttribute($value)
    {
        $this->attributes['provider_token'] = Crypt::encryptString($value);
    }

    public function getProviderTokenAttribute($value)
    {
        // $this->provider_token;
        return Crypt::deCrypt($value);
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    public function gender()
    {
        return $this->belongsTo(gender::class);
    }
    public function hr()
    {
        return $this->hasOne(Hr::class);
    }
    public function registerLog()
    {
        return $this->hasOne(userRegisterLog::class);
    }
    public function registerFee()
    {
        return $this->hasOne(RegistrationFee::class);
    }
}
