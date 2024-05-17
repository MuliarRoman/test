<?php

namespace Roman\Store\Models;

use Model;

/**
 * Model
 */
class Products extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'roman_store_products';

    protected $slugs = ['slug' => 'title'];

    /**
     * @var array rules for validation.
     */
    public $rules = [];

    public $attachOne = [
        'preview' => \System\Models\File::class
    ];

    public $attachMany = [
        'gallery' => \System\Models\File::class
    ];

    public $belongsTo = [
        'category' => \Roman\Store\Models\Categories::class
    ];

    public $belongsToMany = [
        'sizes' => [\Roman\Store\Models\Sizes::class, 'table' => 'roman_store_products_sizes', 'key' => 'size_id', 'otherKey' => 'product_id'],
    ];

    public function scopeListFrontEnd($query, $options = [])
    {
        extract(array_merge([
            'sizes' => '',
            'category' => '',
            'price' => '',
        ], $options));

        $query->with('sizes');
        $query->with('category');

        if ($sizes || $category || $price) {
            $query->where(function ($query) use ($sizes, $category, $price) {
                // if ($size) {
                //     $query->where(function ($query) use ($search) {
                //         $query->where('name', 'like', '%' . $search . '%')
                //               ->orWhere('title', 'like', '%' . $search . '%')
                //               ->orWhere('code', 'like', '%' . $search . '%');
                //     });
                // }

                // if ($search_mobile) {
                //     $query->where(function ($query) use ($search_mobile) {
                //         $query->where('name', 'like', '%' . $search_mobile . '%')
                //               ->orWhere('title', 'like', '%' . $search_mobile . '%')
                //               ->orWhere('code', 'like', '%' . $search_mobile . '%');
                //     });
                // }

                if ($sizes and !in_array('all-sizes', $sizes)) {
                    $query->whereHas('sizes', function ($query) use ($sizes) {
                        $query->whereIn('slug', $sizes);
                    });
                }

                if ($category) {
                    $query->whereHas('category', function ($query) use ($category) {
                        $query->where('slug', $category);
                    });
                }
            });
        }

        return $query->get();
    }
}
