<?php

namespace App\Http\Controllers\web\payments;

use App\Models\Sale;
use App\Models\Quota;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RecalculatePayments extends Controller
{
    public function edit(Sale $sale)
    {
        $quotas = $sale->details->first()->product->quotas;

        return view('payments.edit')->with('sale', $sale)->with('quotas', $quotas);
    }

    public function update(Request $request, Sale $sale)
    {
        if ($sale->delivered_at) {
            return redirect()->back()->with(
                'message',
                ['type' => 'error', 'content' => 'No se puede recalcular el pago de una venta que ya fue entregada']
            );
        }

        $validated = $request->validate([
            'quota_id' => 'required|exists:quotas,id',
            'hour' => 'nullable'
        ]);

        DB::transaction(function () use ($sale, $validated) {
            $sale->payments()->delete();
            
            $quota = Quota::find($validated['quota_id']);

            $deliver_on = $sale->deliver_on;
            
            $previous_payment = null;

            for ($i = 0; $i < $quota->quantity; $i++) {
                $hour = array_key_exists('hour', $validated) ? $validated['hour'] : null;
                
                $payment = Payment::create([
                    'amount' => $quota->quota_amount,
                    'due_date' => $deliver_on->addMonth($i)->format('Y-m-d'),
                    'hour' => $hour,
                    'sale_id' => $sale->id,
                    'previous_id' => $previous_payment
                ]);

                $previous_payment = $payment->id;
            }
        });


        return redirect()->route('sales.show', ['sale' => $sale->id])
            ->with('message', ['type' => 'success', 'content' => 'Se ha recalculado el pago de la venta']);
    }
}
