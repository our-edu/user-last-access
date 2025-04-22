<?php

namespace Ouredu\LastAccess;

use Illuminate\Support\ServiceProvider;
use Ouredu\LastAccess\Listeners\UserLastAccessListener;
use Illuminate\Routing\Events\RouteMatched;
use function LastLoginTracker\database_path;

class LastAccessTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app['events']->listen(RouteMatched::class, UserLastAccessListener::class);
    }

    public function register()
    {
        //
    }
}