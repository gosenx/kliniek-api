<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = ['id'];

    //
    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }

    public function setJobTitle($jobTitle)
    {
        $this->attributes['job_title'] = $jobTitle;
    }

}
