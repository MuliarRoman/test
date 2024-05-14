<?php

namespace Roman\Store\Classes;

class Store
{
    public $key;

    public function __construct($key)
    {
        $this->key = $key;
    }
}
