<?php

namespace App\Providers;

use App\Models\SaleDetail;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.header', function ($view) {
            $view->with('details_without_photo', SaleDetail::doesntHave('photo')->count());
        });
    }
}
