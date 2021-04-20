<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer(['layouts.app', 'layouts.dashboard'], 'App\Composers\SidebarComposer');
    }
}
