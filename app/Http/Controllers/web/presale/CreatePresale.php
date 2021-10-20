<?php

namespace App\Http\Controllers\web\presale;

use App\Models\Phone;
use App\Models\Presale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreatePresale extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "lastname" => ['required'],
            "name" => ['required'],
            "area_code" => ['required'],
            "contact_date" => ['nullable'],
            "number" => ['required'],
            "has_whatsapp" => ['nullable'],
            'street' => ['nullable'],
            'neighborhood' => ['nullable'],
            'number' => ['nullable'],
            "information" => ['nullable'],
        ]);

        $validated['has_whatsapp'] = array_key_exists('has_whatsapp', $validated) ? true : false;
        $validated['seller_id'] = auth()->user()->id;
        
        $presale = Presale::create($validated);
        
        Phone::create([
            'area_code' => $validated['area_code'],
            'number' => $validated['number'],
            'has_whatsapp' => $validated['has_whatsapp'],
            'phoneable_id' => $presale->id,
            'phoneable_type' => get_class($presale)
        ]);

        return redirect()->route('sales.create')
            ->with('message', ['type' => 'success', 'content' => 'Datos de contacto añadidos con éxito!']);
    }
}
