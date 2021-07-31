<?php

namespace App\Http\Controllers\web\addresses;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EditAddress extends Controller
{
    public function edit(Address $address)
    {
        return view('addresses.edit')->with('address', $address);
    }

    public function update(Request $request, Address $address)
    {
        $address->update($this->validated($request));

        $this->checkForHousePhoto($address, $request);

        return redirect()->route('clients.show', ['client' => $address->client_id])
            ->with('message', ['type' => 'success', 'content' => 'Dirección actualizada con éxito,']);
    }

    private function checkForHousePhoto($address, $request)
    {
        if ($request->has('house_photo')) {
            Storage::delete($address->photo);
            $photo_path = $request->house_photo->storePublicly('addresses', 'public');
            
            $address->update(['photo' => $photo_path]);
        }
    }

    private function validated($request)
    {
        return $request->validate([
            "neighborhood" => ['required'],
            "street" => ['required'],
            "number" => ['nullable', 'numeric'],
            "indications" => ['nullable'],
            "details" => ['nullable'],
            "lat" => ['nullable'],
            "lon" => ['nullable'],
        ]);
    }
}
