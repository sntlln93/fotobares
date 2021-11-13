<?php

namespace App\Http\Controllers\web\payments;

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
        
        $feedback_message = DB::transaction(function () use ($request, $payment) {
            $current_payment_amount = $payment->amount;
            $new_payment_amount = floatval($request->amount);

            $feedback_message = "¡Pago guardado con éxito!";

            $payment->update([
                'amount' => $request->amount,
                'paid_at' => Carbon::now(),
                'collector_id' => auth()->user()->id
            ]);

            if (! $payment->previous_id) {
                $payment->sale->update([
                    'delivered_at' => Carbon::now()
                ]);

                $feedback_message = "¡Entrega realizada con éxito!";
            }
            
            if ($current_payment_amount != $new_payment_amount) {
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

            return $feedback_message;
        });

        return redirect()->route('home')
            ->with('message', ['type' => 'success', 'content' => $feedback_message]);
    }

    private function validatePayment($request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
        ]);
    }
}
