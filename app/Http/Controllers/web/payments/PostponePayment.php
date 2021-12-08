<?php

namespace App\Http\Controllers\web\payments;

use App\Models\Sale;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostponePaymentRequest;

class PostponePayment extends Controller
{
    public function form(Sale $sale)
    {
        $sale->load('payments', 'client');
        $nextPayment = $sale->next_payment_to_collect;
        $payments = $sale->payments->toArray();
        $order = -1;

        for ($i = 0; $i < count($payments); $i++) {
            $order = $payments[$i]['id'] === $nextPayment->id ? $i : $order;
        }

        return view('payments.postpone')
        ->with('nextPayment', $nextPayment)
        ->with('order', $order+1)
        ->with('sale', $sale);
    }
    public function update(PostponePaymentRequest $request, Payment $payment)
    {
        $validated = $request->validated();
        
        if ($payment->hour === 'Sin hora de visita registrada' || $validated['hour'] === null) {
            $validated['hour'] = 'Sin hora de visita registrada';
        }

        if ($validated['update_deliver_on']) {
            $payment->sale->update(['deliver_on' => $validated['due_date']]);
        }

        if ($validated['update_following_payments']) {
            $deliver_on = Carbon::parse($validated['due_date']);
            
            foreach ($payment->sale->payments as $p) {
                if ($p->paid_at === null) {
                    $due_date = $p->id === $payment->id ? $deliver_on : $deliver_on->addMonth()->format('Y-m-d');
                    $p->update(['due_date' => $due_date]);
                }
            }
        } else {
            $payment->update(['due_date' => $validated['due_date'], 'hour' => $validated['hour']]);
        }
        

        return redirect()->back()->with('message', ['type' => 'info', 'content' => 'Pago pospuesto al '. $payment->due_date->format('d/m/Y'). ' con éxito.']);
    }
}
