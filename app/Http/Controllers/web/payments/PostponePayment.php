<?php

namespace App\Http\Controllers\web\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PostponePayment extends Controller
{
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'due_date' => ['required', 'date']
        ]);

        $payment->update([
            'due_date' => $request->due_date
        ]);

        return redirect()->back()->with('message', ['type' => 'info', 'content' => 'Pago pospuesto al '. $payment->due_date->format('d/m/Y'). ' con éxito.']);
    }
}
