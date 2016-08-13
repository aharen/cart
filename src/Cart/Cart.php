<?php

namespace aharen\Cart;

class Cart
{

    protected $cart_name;

    protected $cart = [];

    public function __construct()
    {
        $this->cart_name = config('cart.name');
    }

    public function get()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[$this->cart_name])) {
            return false;
        }

        return unserialize($_SESSION[$this->cart_name]);
    }

    public function count()
    {
        $cart = self::get();

        return ($cart === false) ? 0 : count($cart);
    }

    public function add($item, $quantity)
    {
        $cart  = self::get();
        $exist = false;
        if ($cart !== false) {
            foreach ($cart as $key => $value) {
                if ($value['item'] === $item) {
                    $cart[$key]['qty'] += $quantity;
                    $exist = true;
                }
            }
        }

        $entry = [
            'item' => $item,
            'qty'  => $quantity,
        ];

        if ($exist === false) {
            $cart[] = $entry;
        }

        $_SESSION[$this->cart_name] = serialize($cart);
        return true;
    }

    public function remove($item)
    {
        $cart = self::get();
        if ($cart !== false) {
            foreach ($cart as $key => $value) {
                if ($value['item'] === $item) {
                    unset($cart[$key]);
                }
            }
        }

        $_SESSION[$this->cart_name] = serialize($cart);
        return true;
    }

    public function reset()
    {
        $cart = self::get();
        if ($cart !== false) {
            unset($_SESSION[$this->cart_name]);
        }
        return true;

    }
}
