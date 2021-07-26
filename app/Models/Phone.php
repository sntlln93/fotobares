<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $guarded = [];

    public function getFormattedNumberAttribute()
    {
        return '(' . $this->area_code . ') ' . $this->number;
    }

    public function getFullNumberAttribute()
    {
        return $this->area_code.$this->number;
    }

    public function phoneable()
    {
        return $this->morphTo();
    }
}