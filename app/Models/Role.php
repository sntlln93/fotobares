<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function getIsoNameAttribute()
    {
        if ($this->name==='admin') {
            return 'Administrador';
        }
        if ($this->name==='seller') {
            return 'Vendedor';
        }
    }
}
