<?php

namespace Bookkeeper\Booker\Providers;

use Illuminate\Support\ServiceProvider;

class BookerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
    }
}
