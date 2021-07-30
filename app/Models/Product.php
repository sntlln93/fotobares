<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function quotas()
    {
        return $this->hasMany(Quota::class);
    }

    public function getPriceAttribute()
    {
        return $this->quotas->where('quantity', 1)->first()->quota_amount;
    }
}
