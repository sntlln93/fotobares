<?php

namespace App\Http\Controllers\web\sell;

use App\Models\Sale;
use App\Models\Phone;
use App\Models\Client;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\SellRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SellController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('sell.create')->with('products', $products);
    }

    public function store(SellRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $client = Client::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'dni' => $validated['dni'],
            ]);

            $sale = Sale::create([
                'deliver_on' => $validated['deliver_date'],
                'payment_description' => $validated['payment_description'],
                'client_id' => $client->id,
                'seller_id' => auth()->user()->id
            ]);

            $product = Product::find($validated['product_id']);
            $quotas = intval($validated['quotas']);

            for ($i = 0; $i < $quotas; $i++) {
                $now = Carbon::now();
                $hour = array_key_exists('hour', $validated) ? $validated['hour'] : null;
                Payment::create([
                    'amount' => ceil($product->price / $quotas),
                    'due_date' => Carbon::parse($now->year . '-' . $now->month . '-' . $validated['due_date']),
                    'hour' => $hour,
                    'sale_id' => $sale->id,
                ]);
            }

            SaleDetail::create([
                'color' => $validated['color'],
                'amount' => $product->amount,
                'product_id' => $product->id,
                'amount' => $product->price,
                'sale_id' => $sale->id
            ]);

            Address::create([
                'neighborhood' => $validated['address']['neighborhood'],
                'street' => $validated['address']['street'],
                'number' => $validated['address']['number'],
                'indications' => $validated['address']['indications'],
                'details' => $validated['address']['details'],
                'lat' => $validated['address']['lat'],
                'lon' => $validated['address']['lon'],
                'client_id' => $client->id
            ]);

            foreach ($validated['phones'] as $phone) {
                Phone::create([
                    'area_code' => $phone['area_code'],
                    'number' => $phone['number'],
                    'has_whatsapp' => array_key_exists('has_whatsapp', $phone) ?? true,
                    'phoneable_id' => $client->id,
                    'phoneable_type' => get_class($client)
                ]);
            }
        });

        return redirect()->route('sales.index');
    }
}