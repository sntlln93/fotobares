<?php

namespace App\Http\Controllers\web\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PostponePayment extends Controller
{
    public function update(Request $request, Payment $payment)
    {
        $validated=$request->validate([
            'due_date' => ['required', 'date'],
            'hour' => ['nullable']
        ]);

        if ($payment->hour === 'Sin hora de visita registrada' || $validated['hour'] === null) {
            $validated['hour'] = 'Sin hora de visita registrada';
        }

        $payment->update($validated);

        return redirect()->back()->with('message', ['type' => 'info', 'content' => 'Pago pospuesto al '. $payment->due_date->format('d/m/Y'). ' con éxito.']);
    }
}
