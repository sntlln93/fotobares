<?php

namespace App\Http\Controllers\web\sales;

use App\Models\Sale;
use App\Models\Phone;
use App\Models\Client;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\Quota;
use Illuminate\Support\Carbon;
use App\Http\Requests\SellRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SellProduct extends Controller
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
            $quota =   Quota::find($validated['quota_id']);

            $deliver_on = Carbon::parse($validated['deliver_date']);
            
            $previous_payment = null;
            for ($i = 0; $i < $quota->quantity; $i++) {
                $hour = array_key_exists('hour', $validated) ? $validated['hour'] : null;
                $due_date = $i == 0 ? $deliver_on->format('Y-m-d') : $deliver_on->year . '-' . $deliver_on->addMonth($i)->month . '-' . $validated['due_date'];
                
                $payment = Payment::create([
                    'amount' => $quota->quota_amount,
                    'due_date' => $due_date,
                    'hour' => $hour,
                    'sale_id' => $sale->id,
                    'previous_id' => $previous_payment
                ]);

                $previous_payment = $payment->id;
            }

            SaleDetail::create([
                'amount' => $quota->quota_amount * $quota->quantity,
                'color' => $validated['color'],
                'product_id' => $product->id,
                'sale_id' => $sale->id
            ]);

            if (array_key_exists('house_photo', $validated)) {
                $photo_path = $validated['house_photo']->storePublicly('addresses', 'public');
            }

            Address::create([
                'neighborhood' => $validated['address']['neighborhood'],
                'street' => $validated['address']['street'],
                'number' => $validated['address']['number'],
                'indications' => $validated['address']['indications'],
                'details' => $validated['address']['details'],
                'lat' => $validated['address']['lat'],
                'lon' => $validated['address']['lon'],
                'photo' => $photo_path ?? null,
                'client_id' => $client->id
            ]);

            foreach ($validated['phones'] as $phone) {
                Phone::create([
                    'area_code' => $phone['area_code'],
                    'number' => $phone['number'],
                    'has_whatsapp' => array_key_exists('has_whatsapp', $phone) ?? false,
                    'phoneable_id' => $client->id,
                    'phoneable_type' => get_class($client)
                ]);
            }
        });
        return redirect()->route('sales.index')
            ->with('message', ['type' => 'success', 'content' => '¡Venta añadida con éxito!']);
    }
}
