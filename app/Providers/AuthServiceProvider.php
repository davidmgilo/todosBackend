<?php

namespace Davidmgilo\TodosBackend\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Gate;
use Route;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Davidmgilo\TodosBackend\Task' => 'Davidmgilo\TodosBackend\Policies\TaskPolicy',
//        'Davidmgilo\TodosBackend\User' => 'Davidmgilo\TodosBackend\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Route::group(['middleware' => 'cors'], function() {
            Passport::routes();
        });

        Passport::enableImplicitGrant();

        $this->defineGates();

    }

    private function defineGates()
    {
        Gate::define('impossible-gate', function () {
            return false;
        });

        Gate::define('easy-gate', function () {
            return true;
        });

    }
}
