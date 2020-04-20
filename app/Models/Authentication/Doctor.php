<?php

namespace App\Models\Authentication;

use App\Models\Specialty;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
