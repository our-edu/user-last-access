<?php

namespace Ouredu\UserLastAccess;

use Illuminate\Support\ServiceProvider;
use Ouredu\UserLastAccess\Listeners\UserLastAccessListener;
use Illuminate\Routing\Events\RouteMatched;

class LastAccessServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Update paths to point to the correct location of the migrations folder
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app['events']->listen(RouteMatched::class, function (RouteMatched $event) {
            $listener = new UserLastAccessListener();
            $listener->handle();
        });
    }

    public function register()
    {
        //
    }
}