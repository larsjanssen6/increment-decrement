<?php

namespace LarsJanssen\IncrementDecrement;

use Illuminate\Support\ServiceProvider;
use LarsJanssen\IncrementDecrement\Repository\OrderRepository;

class IncrementDecrementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/increment-decrement.php' => config_path('increment-decrement.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__.'/../config/increment-decrement.php', 'increment-decrement');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('order', function () {
            return new Order(new OrderRepository());
        });
    }
}
