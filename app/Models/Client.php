<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $guarded = [];

    public function getTotalPaidAttribute()
    {
        $salesId = $this->sales->pluck('id');

        return DB::table('payments')->whereNotNull('paid_at')->whereIn('sale_id', $salesId)->sum('amount');
    }

    public function getBalanceAttribute()
    {
        $salesId = $this->sales->pluck('id');

        return DB::table('payments')->whereNull('paid_at')->whereIn('sale_id', $salesId)->sum('amount');
    }

    public function getCompletedPaymentsPercentageAttribute()
    {
        $total = $this->payments->count();
        $completed = $this->payments->whereNotNull('paid_at')->count();

        return number_format($completed * 100 / $total, 1);
    }

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->name;
    }

    //relationships
    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Sale::class);
    }
}
