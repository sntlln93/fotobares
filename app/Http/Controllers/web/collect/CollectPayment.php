<?php

namespace App\Http\Controllers\web\collect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Sale;
use App\Models\Payment;

class CollectPayment extends Controller
{
    public function index(Sale $sale)
    {
        return view('payments.collect')->with('sale', $sale->load('payments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $this->validatePayment($request);

        $payment->update([
            'amount' => $request->amount,
            'paid_at' => Carbon::now(),
            'collector_id' => auth()->user()->id
        ]);

        return redirect()->route('collect', ['sale' => $payment->sale_id]);
    }

    private function validatePayment($request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
        ]);
    }
}