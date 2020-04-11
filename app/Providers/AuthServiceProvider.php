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
        \Task::class => \TaskPolicy::class
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        /* Gate::define('update-task', function ($user, $task) {
            return $user->id === $task->creator->id;
        });

        Gate::define('edit-task', function ($user, $task) {
            return $user->id === $task->creator->id;
        });

        Gate::define('delete-task', function ($user, $task) {
            return $user->id === $task->creator->id;
        }); */
    }
}
