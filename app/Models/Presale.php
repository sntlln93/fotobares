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
        'address_street',
        'address_neighborhood',
        'address_number'
    ];

    protected $dates = ['contact_date'];

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }

    public function getFullAddressAttribute()
    {
        return $this->address_neighborhood. ', ' . $this->address_street. 'N° ' . $this->address_number;
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
