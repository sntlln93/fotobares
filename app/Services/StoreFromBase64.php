<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StoreFromBase64
{
    public function store($base64)
    {
        $extension = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($base64, 0, strpos($base64, ',')+1);
      
        // find substring fro replace here eg: data:image/png;base64,
      
        $image = str_replace($replace, '', $base64);
      
        $image = str_replace(' ', '+', $image);
      
        $name = Str::random(40).'.'.$extension;
      
        Storage::disk('public')->put('addresses/'.$name, base64_decode($image));

        return 'addresses/' . $name;
    }
}
