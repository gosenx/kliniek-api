<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }
}
