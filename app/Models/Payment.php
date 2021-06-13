<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    protected $dates = ['due_date'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function collector()
    {
        return $this->belongsTo(Employee::class, 'collector_id');
    }

    public function getHourAttribute($value)
    {
        return $value ? $value : 'Sin hora de visita registrada';
    }
}