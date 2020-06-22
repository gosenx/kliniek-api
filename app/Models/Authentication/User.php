<?php

namespace App\Models\Authentication;

use App\Models\Contact;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->morphTo();
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function hasPatientProfile(): bool
    {
        return $this->profile_type == Patient::class;
    }

    public function hasDoctorProfile(): bool
    {
        return $this->profile_type == Doctor::class;
    }

    public function getProfileType(): string
    {
        if ($this->profile_type == Patient::class) {
            return 'patient';
        } else if ($this->profile_type == Doctor::class) {
            return 'doctor';
        }
        return 'profile not identified';
    }

    public static function patients()
    {
        return self::query()->where('profile_type', '=', Patient::class)->get();
    }

    public static function doctors()
    {
        return self::query()->where('profile_type', '=', Doctor::class)->get();
    }
}
