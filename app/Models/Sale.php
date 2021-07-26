<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];
    protected $dates = ['deliver_on', 'delivered_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function seller()
    {
        return $this->belongsTo(Employee::class, 'seller_id');
    }

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getDeliveredAtAttribute($value)
    {
        return $value ? $value : false;
    }

    public function getNextPaymentToCollectAttribute()
    {
        return $this->payments->whereNull('paid_at')->first();
    }
}