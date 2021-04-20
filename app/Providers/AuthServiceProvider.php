<?php

namespace App\Providers;

use App\Comment;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->abilities()->contains($ability);
        });

        Gate::define('view', function (User $user, Comment $comment) {
            return true;
        });
    }
}
