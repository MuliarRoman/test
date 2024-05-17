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
        $size = post('size', null); // Assuming you get product data from a form
        $product = post('product'); // Assuming you get product data from a form
        $data = json_decode($product, true);
        $data['size'] = $size;
        Cart::addProduct($data);
        $this->page['cart'] = Cart::getCart();
        // return redirect('/cart'); // Redirect to the cart page
    }

    public function onClearCart()
    {
        Cart::clearCart();
        $this->page['cart'] = Cart::getCart();
    }
}
