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
        'contact_date',
        'street',
        'neighborhood',
        'number'
    ];

    protected $dates = ['contact_date'];

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }

    public function getFullAddressAttribute()
    {
        return $this->neighborhood. ', ' . $this->street. 'N° ' . $this->number;
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
