<?php

namespace aharen\Cart;

use aharen\Cart\Cart;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class CartServiceProvider extends LaravelServiceProvider
{
    public function register()
    {
        $this->app->singleton('aharen\Cart\Cart', function ($app) {
            return new Cart($app);
        });
    }
}
