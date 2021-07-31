<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function getFormattedDeliveredAtAttribute()
    {
        return $this->delivered_at ? Carbon::parse($this->delivered_at)->isoFormat('D [de] MMMM Y [a las] H:m') : '';
    }

    public function getFormattedDeliverOnAttribute()
    {
        return $this->deliver_on ? Carbon::parse($this->deliver_on)->isoFormat('D [de] MMMM Y') : '';
    }

    public function getNextPaymentToCollectAttribute()
    {
        return $this->payments->whereNull('paid_at')->first();
    }
}
