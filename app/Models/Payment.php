<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Payment extends Model
{
    protected $guarded = [];
    protected $dates = ['due_date', 'paid_at'];

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

    public function getFormattedPaidAtAttribute()
    {
        return Carbon::parse($this->paid_at)->isoFormat('D [de] MMMM Y');
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::parse($this->due_date)->isoFormat('D [de] MMMM Y');
    }
}