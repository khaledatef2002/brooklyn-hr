<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['logo', 'name', 'description', 'is_internship_form_avilable'];
    public $timestamps = false;
}
