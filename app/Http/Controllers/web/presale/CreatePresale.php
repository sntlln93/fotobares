<?php

namespace App\Http\Controllers\web\presale;

use Illuminate\Http\Request;
use App\Models\Presale;
use App\Http\Controllers\Controller;

class CreatePresale extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "lastname" => ['required'],
            "name" => ['required'],
            "area_code" => ['required'],
            "number" => ['required'],
            "has_whatsapp" => ['nullable'],
            "information" => ['nullable'],
        ]);

        $validated['has_whatsapp'] = $validated['has_whatsapp'] ? true : false;

        Presale::create($validated);

        return redirect()->route('sales.create')
            ->with('message', ['type' => 'success', 'content' => 'Datos de contacto añadidos con éxito!']);
    }
}
