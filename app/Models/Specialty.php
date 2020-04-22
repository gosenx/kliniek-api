<?php

namespace App\Models;

use App\Models\Authentication\Doctor;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
