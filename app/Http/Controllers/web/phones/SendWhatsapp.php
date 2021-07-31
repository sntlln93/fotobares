<?php

namespace App\Http\Controllers\web\phones;

use App\Models\Phone;
use App\Http\Controllers\Controller;

class SendWhatsapp extends Controller
{
    public function send(Phone $phone)
    {
        return redirect($this->url($phone));
    }

    private function url($phone)
    {
        $client = $phone->phoneable;

        return "https://api.whatsapp.com/send?phone=54".$phone->full_number."&text=".$this->message($client)."&source=&data=&app_absent=";
    }

    private function message($client)
    {
        return "¡Hola, ".$client->name."!";
    }
}
