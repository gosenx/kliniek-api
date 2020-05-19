<?php

namespace App\Models\Authentication;

use App\Models\Business\Appointment;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function scheduledAppointments()
    {
        return $this->appointments()->where('state', '=', 'scheduled')->get();
    }

    public function ongoingAppointments()
    {
        return $this->appointments()->where('state', '=', 'ongoing')->get();
    }

    public function completedAppointments()
    {
        return $this->appointments()->where('state', '=', 'complete')->get();
    }
}
