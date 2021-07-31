<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    public function getFormattedAddressAttribute()
    {
        return $this->neighborhood . ', ' . $this->street . ' ' . $this->number;
    }

    public function getHasLocationAttribute()
    {
        return $this->lat and $this->lon ? true : false;
    }
}
