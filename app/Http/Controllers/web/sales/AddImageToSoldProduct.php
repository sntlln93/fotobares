<?php

namespace App\Http\Controllers\web\sales;

use App\Http\Controllers\Controller;
use App\Services\GetSaleDetailsWithoutPhoto;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Photo;
use App\Models\SaleDetail;

class AddImageToSoldProduct extends Controller
{
    public function __construct(GetSaleDetailsWithoutPhoto $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $details = $this
            ->service
            ->get()
            ->with('sale.client', 'photo', 'product')
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
            'photo' => ['required']
        ]);

        $photo_path = $request->photo->storePublicly('sold', 'public');

        Photo::create([
            'path' => $photo_path,
            'description' => $request->description,
            'sale_detail_id' => $detail->id
        ]);

        return redirect()
            ->route('sales.show', ['sale' => $detail->sale_id])
            ->with('message', ['type' => 'success', 'content' => '¡Foto añadida con éxito!']);
    }
}
