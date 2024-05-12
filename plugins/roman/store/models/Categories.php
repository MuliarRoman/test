<?php

namespace Roman\Store\Models;

use Model;

/**
 * Model
 */
class Categories extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var bool timestamps are disabled.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    protected $slugs = ['slug' => 'name'];

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'roman_store_categories';

    /**
     * @var array rules for validation.
     */
    public $rules = [];

    public $attachOne = [
        'preview' => \System\Models\File::class
    ];

    public $hasMany = [
        'products' => [\Roman\Store\Models\Products::class, 'key' => 'category_id', 'otherKey' => 'id']
    ];
}
