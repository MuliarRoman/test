<?php

namespace Roman\Store\Components;

use Cms\Classes\ComponentBase;
use Flash;
use RainLab\User\Models\User;
use Roman\Store\Classes\Cart;
use Roman\Store\Models\Order;
use Validator;
use ValidationException;

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

    public function onSaveOrder()
    {
        $data = post();

        $rules = [
            'last_name' => 'required',
            'first_name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'card_number' => 'required|digits:16',
            'card_expiry' => 'required|date_format:m/y',
            'card_csv' => 'required|digits:3',
        ];

        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $order = new Order();
        foreach ($data as $key => $val) {
            if ($key !== 'user_id') {
                $order->$key = $val;
            }
        }
        $order->cart = json_encode(Cart::getCart());
        if (isset($data['user_id'])) {
            $order->user()->associate(User::find($data['user_id']));
        }
        $order->save();
        Flash::success('Замовлення створенне!');
        Cart::clearCart();
        $this->page['cart'] = Cart::getCart();
        return [
            '#cart-table' => $this->renderPartial('table-cart', ['cart' => Cart::getCart()]),
            '#notify-cart-number' => $this->renderPartial('notify-cart-number', ['cart' => Cart::getCart()])
        ];
    }

    public function onAddToCart()
    {
        $size = post('size', null); // Assuming you get product data from a form
        $product = post('product'); // Assuming you get product data from a form
        $data = json_decode($product, true);
        $data['size'] = $size;
        $data['id'] = (string)$data['id'] . $size;
        Cart::addProduct($data);
        $this->page['cart'] = Cart::getCart();
        Flash::success('Добавлино в кошик!');
        return ['success' => true];
        // return redirect('/cart'); // Redirect to the cart page
    }

    public function onRemoveProduct()
    {
        $productId = post('product_id');

        if ($productId) {
            Cart::removeProduct($productId);
            Flash::success('Видалено успішно!');
            return [
                '#cart-table' => $this->renderPartial('table-cart', ['cart' => Cart::getCart()]),
                '#notify-cart-number' => $this->renderPartial('notify-cart-number', ['cart' => Cart::getCart()])
            ];
        }

        // Flash::error('Продукт не знайдено!');
        return ['success' => false, 'message' => 'Product ID not provided'];
    }

    public function onIncrementProduct()
    {
        $productId = post('product_id');

        if ($productId) {
            Cart::incrementProduct($productId);
            $this->page['cart'] = Cart::getCart(); // Update the cart data
            Flash::success('Кошик оновлено!');
            return [
                '#cart-table' => $this->renderPartial('table-cart', ['cart' => Cart::getCart()]),
                '#notify-cart-number' => $this->renderPartial('notify-cart-number', ['cart' => Cart::getCart()])
            ];
        }

        return ['success' => false, 'message' => 'Product ID not provided'];
    }

    public function onDecrementProduct()
    {
        $productId = post('product_id');

        if ($productId) {
            Cart::decrementProduct($productId);
            $this->page['cart'] = Cart::getCart(); // Update the cart data
            Flash::success('Кошик оновлено!');
            return [
                '#cart-table' => $this->renderPartial('table-cart', ['cart' => Cart::getCart()]),
                '#notify-cart-number' => $this->renderPartial('notify-cart-number', ['cart' => Cart::getCart()])
            ];
        }

        return ['success' => false, 'message' => 'Product ID not provided'];
    }

    public function onClearCart()
    {
        Cart::clearCart();
        $this->page['cart'] = Cart::getCart();
        Flash::success('Очистка кошика успішна!');
    }
}
