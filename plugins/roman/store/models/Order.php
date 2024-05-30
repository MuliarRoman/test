<?php

namespace Roman\Store\Models;

use Model;

/**
 * Model
 */
class Order extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'roman_store_order';

    /**
     * @var array rules for validation.
     */
    public $rules = [];

    public $casts = [
        'cart' => 'array'
    ];

    public $belongsTo = [
        'user' => ['RainLab\User\Models\User']
    ];
}
