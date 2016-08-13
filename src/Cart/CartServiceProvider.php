<?php

namespace aharen\Cart;

use aharen\Cart\Cart;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class CartServiceProvider extends LaravelServiceProvider
{

    public function boot()
    {
        $source = realpath(__DIR__ . '/../../config/cart.php');

        $this->publishes([
            $source => config_path('cart.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('aharen\Cart\Cart', function ($app) {
            return new Cart($app);
        });
    }
}
