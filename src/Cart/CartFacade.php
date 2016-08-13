<?php

namespace aharen\Cart;

use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'aharen\Cart\Cart';
    }
}
