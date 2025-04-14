<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $guarded = ['id'];

    public function educations()
    {
        return $this->hasMany(JobApplicationEducation::class);
    }
    public function workExperiences()
    {
        return $this->hasMany(JobApplicationWorkExperience::class);
    }
}
