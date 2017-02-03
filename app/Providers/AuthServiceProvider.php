<?php

namespace App\Providers;

use App\Auth\EloquentCustomerUserProvider;
use App\Auth\EloquentEmployeeUserProvider;
use Auth;
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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        // Binding custom providers from auth config
        Auth::provider('eloquent.employee', function ($app, array $config) {
            return new EloquentEmployeeUserProvider($app['hash'], $config['model']);
        });
        Auth::provider('eloquent.customer', function ($app, array $config) {
            return new EloquentCustomerUserProvider($app['hash'], $config['model']);
        });
    }
}
