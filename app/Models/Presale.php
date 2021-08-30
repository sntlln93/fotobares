<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presale extends Model
{
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }

    public function getFormattedNumberAttribute()
    {
        return '(' . $this->area_code . ') ' . $this->number;
    }
}
