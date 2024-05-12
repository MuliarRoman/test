<?php

namespace Roman\Store\Models;

use Model;

/**
 * Model
 */
class Sizes extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var bool timestamps are disabled.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'roman_store_sizes';

    protected $slugs = ['slug' => 'name'];

    /**
     * @var array rules for validation.
     */
    public $rules = [];

    public $hasMany = [
        'products' => [\Roman\Store\Models\Products::class, 'key' => 'size_id', 'otherKey' => 'id']
    ];
}
