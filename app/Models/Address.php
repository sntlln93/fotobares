<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];
    protected $appends = ['formatted_address'];

    public function getFormattedAddressAttribute()
    {
        return $this->neighborhood . ', ' . $this->street . ' ' . $this->number;
    }

    public function getHasLocationAttribute()
    {
        return $this->lat && $this->lon ? true : false;
    }

    //relationships

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
