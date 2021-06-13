<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}