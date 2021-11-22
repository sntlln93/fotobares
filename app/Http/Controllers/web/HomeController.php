<?php

namespace App\Http\Controllers\web;

use App\Models\Sale;
use App\Models\Presale;
use App\Http\Controllers\Controller;
use App\Http\Services\PaymentsToCollect;
use App\Http\Services\SalesToDeliver;

class HomeController extends Controller
{
    public function home()
    {
        $roles = auth()->user()->roles->pluck('name')->toArray();

        if (array_search('admin', $roles) !== false) {
            return $this->homeForAdmins();
        }

        if (array_search('seller', $roles) !== false) {
            return $this->homeForSellers();
        }
    }

    private function homeForSellers()
    {
        $sales = Sale::query()
            ->with('payments', 'client.phones', 'client.address', 'details.product')
            ->where('seller_id', auth()->user()->id)
            ->get();

        $presales = Presale::query()
            ->where('seller_id', auth()->user()->id)
            ->get();

        return view('home.seller')->with('sales', $sales)->with('presales', $presales);
    }

    private function homeForAdmins()
    {
        $payments = (new PaymentsToCollect)->get()->take(10);

        $deliveries = (new SalesToDeliver)->get()->take(10)->get();

        return view('home.admin')->with('deliveries', $deliveries)->with('payments', $payments);
    }
}
