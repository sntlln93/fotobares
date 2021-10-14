<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presale extends Model
{
    protected $fillable = [
        "lastname",
        "name",
        "information",
        'seller_id',
        'contact_date'
    ];

    protected $dates = ['contact_date'];

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }

    public function seller()
    {
        return $this->belongsTo(Employee::class);
    }

    public function phone()
    {
        return $this->morphOne(Phone::class, 'phoneable');
    }
}
