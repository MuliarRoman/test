<?php

namespace Roman\Store\Components;

use Cms\Classes\ComponentBase;
use Roman\Store\Classes\Cart;

class ShoppingCart extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Shopping Cart',
            'description' => 'Display products and the shopping cart.'
        ];
    }

    public function onRun()
    {
        $this->page['cart'] = Cart::getCart();
    }

    public function onAddToCart()
    {
        $product = post('product'); // Assuming you get product data from a form
        Cart::addProduct($product);
        $this->page['cart'] = Cart::getCart();
        // return redirect('/cart'); // Redirect to the cart page
    }

    public function onClearCart()
    {
        Cart::clearCart();
        $this->page['cart'] = Cart::getCart();
    }
}
