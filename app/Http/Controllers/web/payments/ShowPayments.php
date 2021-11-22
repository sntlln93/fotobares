<?php

namespace App\Http\Controllers\web\payments;

use App\Http\Controllers\Controller;
use App\Http\Services\PaymentsToCollect;

class ShowPayments extends Controller
{
    public function index()
    {
        $payments = (new PaymentsToCollect)->get();

        return view('payments.index')->with('payments', $payments);
    }
}
