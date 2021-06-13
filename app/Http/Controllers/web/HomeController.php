<?php

namespace App\Http\Controllers\web;

use App\Models\Sale;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $sales = Sale::query()
            ->orderBy('sales.created_at', 'desc')
            ->with(['details', 'client', 'seller'])
            ->withSum('details', 'amount')
            ->take(10)
            ->get();

        $closest_payments = Payment::select(
            'sale_id',
            DB::raw('if(hour is null, "Sin hora de visita registrada", hour) as hour'),
            'amount',
            DB::raw('min(due_date) as due_date')
        )
            ->whereNull('paid_at')
            ->groupBy('sale_id', 'hour', 'amount');

        $payments = Sale::select(
            'sales.client_id as client_id',
            DB::raw('concat(clients.name, " ", clients.lastname) as client_name'),
            'sales.id as sale_id',
            DB::raw('if(sales.delivered_at is null, false, true) as delivered_at'),
            'payments.amount',
            'payments.due_date',
            'payments.hour',
            DB::raw('concat(phones.area_code, phones.number) as number'),
            'phones.has_whatsapp',
            DB::raw('if(addresses.lat is null AND addresses.lon is null, false, true) AS has_location')
        )
            ->joinSub($closest_payments, 'payments', function ($join) {
                $join->on('sales.id', '=', 'payments.sale_id');
            })
            ->join('clients', 'sales.client_id', 'clients.id')
            ->join('addresses', 'clients.id', 'addresses.client_id')
            ->join('phones', 'clients.id', 'phones.phoneable_id')
            ->take(5)
            ->get();

        return view('home')->with('sales', $sales)
            ->with('payments', collect($payments));
    }
}