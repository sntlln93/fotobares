<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
