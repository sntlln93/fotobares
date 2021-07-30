<?php

namespace App\Http\Controllers\web\collect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Sale;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
class CollectPayment extends Controller
{
    public function index(Sale $sale)
    {
        return view('payments.collect')->with('sale', $sale->load('payments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $this->validatePayment($request);
        
        DB::transaction(function () use($request, $payment) {
            $current_payment_amount = $payment->amount;
            $new_payment_amount = floatval($request->amount);

            $payment->update([
                'amount' => $request->amount,
                'paid_at' => Carbon::now(),
                'collector_id' => auth()->user()->id
            ]);
            
            if( $current_payment_amount != $new_payment_amount) {
                $nextPayment = $payment->next;
                $balance = $current_payment_amount - $new_payment_amount;
                
                $nextPayment 
                    ? $nextPayment->update([ 
                        'amount' => $nextPayment->amount + $balance,
                    ])
                    : Payment::create([
                        'amount' => $balance,
                        'due_date' => $payment->due_date,
                        'hour' => $payment->hour,
                        'sale_id' => $payment->sale_id,
                        'previous_id' => $payment->id
                    ]);
            }
        });

        return redirect()->route('collect', ['sale' => $payment->sale_id])
            ->with('message', ['type' => 'success', 'content' => '¡Pago guardado con éxito!']);
    }

    private function validatePayment($request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
        ]);
    }
}