<?php

namespace Roman\Store\Classes;

use Session; // Import the Session class

class Cart extends Store
{
    public static function addProduct($product)
    {
        $cart = self::getCart();
        $cart[] = $product;
        self::saveCart($cart);
    }

    public static function getCart()
    {
        return Session::get('cart', []);
    }

    public static function saveCart($cart)
    {
        Session::put('cart', $cart);
    }

    public static function clearCart()
    {
        Session::forget('cart');
    }
}
