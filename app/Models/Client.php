<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\DB;
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

    public function getCompletedPaymentsPercentage()
    {
        $salesId = $this->sales->pluck('id');

        $payments = DB::table('payments')->whereIn('sale_id', $salesId);
        $completed = $payments->whereNotNull('paid_at')->count();
        $total = $payments->whereNull('paid_at')->count();

        return $completed * 100 / $total;
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
}