<?php

namespace App\Http\Controllers\web\clients;

use App\Rules\Name;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditClient extends Controller
{
    public function edit(Client $client)
    {
        return view('clients.edit')->with('client', $client);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => ['required','max:60', new Name],
            'lastname' => ['required','max:60', new Name],
            'dni' => ['required','numeric'],
        ]);

        $client->update($validated);

        return redirect()->route('clients.show', ['client' => $client->id]);
    }
}
