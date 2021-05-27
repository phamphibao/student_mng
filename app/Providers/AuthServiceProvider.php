<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
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
        $user = Auth::user();

        Gate::after(function ($user) {
           return ($user->key === 'isAdmin') ? true : "";
        });
        Gate::define('isAdmin', function ($user) {
            return ($user->key === 'isAdmin') ? true : "";
        });


        Gate::define('view-student', function ($user) {
            return $user->checkPermission('view-student');
        });

        Gate::define('edit-student', function ($user) {
            return $user->checkPermission('edit-student');
        });

        Gate::define('delete-student', function ($user) {
            return $user->checkPermission('delete-student');
        });

        Gate::define('view-class', function ($user) {
            return $user->checkPermission('view-class');
        });

        Gate::define('add-class', function ($user) {
            return $user->checkPermission('add-class');
        });

        Gate::define('edit-class', function ($user) {
            return $user->checkPermission('edit-class');
        });

        Gate::define('delete-class', function ($user) {
            return $user->checkPermission('delete-class');
        });

        Gate::define('view-teacher', function ($user) {
            return $user->checkPermission('view-teacher');
        });

        Gate::define('edit-teacher', function ($user) {
            return $user->checkPermission('edit-teacher');
        });

        Gate::define('delete-teacher', function ($user) {
            return $user->checkPermission('delete-teacher');
        });

        Gate::define('view-faculty', function ($user) {
            return $user->checkPermission('view-faculty');
        });

        Gate::define('add-faculty', function ($user) {
            return $user->checkPermission('add-faculty');
        });

        Gate::define('delete-faculty', function ($user) {
            return $user->checkPermission('delete-faculty');
        });

        Gate::define('edit-faculty', function ($user) {
            return $user->checkPermission('edit-faculty');
        });
    }
}
