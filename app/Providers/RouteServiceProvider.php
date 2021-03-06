<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware(['web'])
                ->namespace($this->namespace)
                ->group(base_path('routes/web/auth.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('addresses')
                ->group(base_path('routes/web/addresses.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('clients')
                ->group(base_path('routes/web/client.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('employees')
                ->group(base_path('routes/web/employee.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('map')
                ->group(base_path('routes/web/map.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('phones')
                ->group(base_path('routes/web/phones.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('presale')
                ->group(base_path('routes/web/presale.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('products')
                ->group(base_path('routes/web/products.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('sales')
                ->group(base_path('routes/web/sales.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->prefix('payments')
                ->group(base_path('routes/web/payment.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/web/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
