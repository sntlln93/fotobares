<?php

namespace App\Http\Controllers\web\phones;

use App\Models\Phone;
use App\Rules\AreaCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\PhoneNumber;

class EditPhone extends Controller
{
    public function edit(Phone $phone)
    {
        return view('phones.edit')->with('phone', $phone);
    }

    public function update(Request $request, Phone $phone)
    {
        $phone->update($this->validated($request));

        return redirect()->route('clients.show', ['client' => $phone->phoneable_id])
            ->with('message', ['type' => 'success', 'content' => 'Teléfono actualizado con éxito,']);
    }

    private function validated($request)
    {
        $validated = $request->validate([
            'area_code' => ['required', new AreaCode],
            'number' => ['required', new PhoneNumber],
            'has_whatsapp' => ['nullable']
        ]);

        if (! array_key_exists('has_whatsapp', $validated)) {
            $validated['has_whatsapp'] = 0;
        }

        return $validated;
    }
}
