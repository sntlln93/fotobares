<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }
}
