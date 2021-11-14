<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('see-employees', function (\App\Models\User $user) {
            $user_roles = $user->roles->pluck('name')->toArray();
            return in_array("admin", $user_roles);
        });

        Gate::define('see-sales-with-no-photo', function (\App\Models\User $user) {
            $user_roles = $user->roles->pluck('name')->toArray();
            return in_array("admin", $user_roles);
        });

        Gate::define('see-products', function (\App\Models\User $user) {
            $user_roles = $user->roles->pluck('name')->toArray();
            return in_array("admin", $user_roles);
        });

        Gate::define('see-sales', function (\App\Models\User $user) {
            $user_roles = $user->roles->pluck('name')->toArray();
            return in_array("admin", $user_roles) || in_array("seller", $user_roles);
        });

        Gate::define('perform-action-on-sale', function (\App\Models\User $user) {
            $user_roles = $user->roles->pluck('name')->toArray();
            return in_array("admin", $user_roles);
        });

        Gate::define('manufacture', function (\App\Models\User $user) {
            $user_roles = $user->roles->pluck('name')->toArray();
            return in_array("admin", $user_roles);
        });
    }
}
