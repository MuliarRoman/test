<?php

namespace Roman\Store\Classes;

use Session; // Import the Session class

class Cart extends Store
{
    public static function incrementProduct($productId)
    {
        $cart = self::getCart();

        foreach ($cart as &$item) {
            if ($item['id'] == $productId) {
                $item['count'] += 1;
                break;
            }
        }

        self::saveCart($cart);
    }

    public static function decrementProduct($productId)
    {
        $cart = self::getCart();

        foreach ($cart as &$item) {
            if ($item['id'] == $productId && $item['count'] > 1) {
                $item['count'] -= 1;
                break;
            }
        }

        self::saveCart($cart);
    }

    public static function addProduct($product)
    {
        $cart = self::getCart();

        // Перевіряємо, чи продукт вже є у кошику
        $found = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $product['id']) { // Порівнюємо за id
                if ($item['size'] == $product['size']) { // Якщо збігається розмір, збільшуємо кількість
                    $item['count'] += 1;
                    $found = true;
                    break;
                }
            }
        }

        // Якщо продукт не знайдено за id або розміром, додаємо новий продукт
        if (!$found) {
            $cart[] = $product;
        }

        self::saveCart($cart);
    }

    public static function removeProduct($productId)
    {
        $cart = self::getCart();

        // Filter out the product with the given ID
        $cart = array_filter($cart, function ($item) use ($productId) {
            return $item['id'] !== $productId;
        });

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
