<?php

namespace aharen\Cart;

class Cart
{

    const CARTNAME = 'mycartmenu';

    protected static $cart = [];

    public static function get()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[self::CARTNAME])) {
            return false;
        }

        return unserialize($_SESSION[self::CARTNAME]);
    }

    public static function add($item, $quantity)
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

        $_SESSION[self::CARTNAME] = serialize($cart);
        return true;
    }

    public static function remove($item)
    {
        $cart = self::get();
        if ($cart !== false) {
            foreach ($cart as $key => $value) {
                if ($value['item'] === $item) {
                    unset($cart[$key]);
                }
            }
        }

        $_SESSION[self::CARTNAME] = serialize($cart);
        return true;
    }

    public static function reset()
    {
        $cart = self::get();
        if ($cart !== false) {
            unset($_SESSION[self::CARTNAME]);
        }
        return true;

    }
}
