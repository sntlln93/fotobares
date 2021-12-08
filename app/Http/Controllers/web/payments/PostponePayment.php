<?php

namespace App\Http\Controllers\web\payments;

use App\Models\Payment;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostponePaymentRequest;

class PostponePayment extends Controller
{
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
                $due_date = $p->id === $payment->id ? $deliver_on : $deliver_on->addMonth()->format('Y-m-d');
                $p->update(['due_date' => $due_date]);
            }
        } else {
            $payment->update($validated);
        }
        

        return redirect()->back()->with('message', ['type' => 'info', 'content' => 'Pago pospuesto al '. $payment->due_date->format('d/m/Y'). ' con éxito.']);
    }
}
