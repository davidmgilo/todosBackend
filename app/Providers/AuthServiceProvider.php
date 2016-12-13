<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Gate;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

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

        Gate::define('update-task', function ($user, $task) {
            return $user->id == $task->user_id;
        });

        Gate::define('update-task1', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('update-task2', function ($user, $task) {
            if($user->isAdmin()) return true;
            return $user->id == $task->user_id;
        });

        Gate::define('show-tasks', function ($user) {
            return true;
        });

    }
}
