<?php

namespace App\Http\Controllers\web\sales;

use App\Models\Photo;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AddImageToSoldProduct extends Controller
{
    public function index()
    {
        $details = SaleDetail::query()
            ->doesntHave('photo')
            ->with('sale.client', 'product')
            ->paginate(20);

        return view('sold-without-photo.index')->with('details', $details);
    }

    public function edit(SaleDetail $detail)
    {
        return view('sold-without-photo.edit')->with('detail', $detail);
    }

    public function update(Request $request, SaleDetail $detail)
    {
        $request->validate([
            'photo' => ['required', 'mimes:png,jpg'],
            'description' => ['nullable'],
            
        ]);

        DB::transaction(function () use ($request, $detail) {
            $photo_path = $request->photo->storePublicly('sold', 'public');

            Photo::create([
                'path' => $photo_path,
                'sale_detail_id' => $detail->id
            ]);

            $detail->update([
                'description' => $request->description,
                'edited_at' => Carbon::now()
            ]);
        });

        return redirect()
            ->route('sales.show', ['sale' => $detail->sale_id])
            ->with('message', ['type' => 'success', 'content' => '¡Foto añadida con éxito!']);
    }
}
