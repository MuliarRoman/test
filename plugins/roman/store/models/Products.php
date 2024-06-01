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
            'page' => 1,
            'sizes' => '',
            'category' => '',
            'price' => '',
        ], $options));

        $query->with('sizes');
        $query->with('category');

        if ($sizes || $category || $price || $page) {
            $query->where(function ($query) use ($sizes, $category, $price, $page) {
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
                if ($price) {
                    // Split the price string into min and max values
                    $priceRange = explode(',', $price);
                    $minPrice = isset($priceRange[0]) ? (float)$priceRange[0] : null;
                    $maxPrice = isset($priceRange[1]) ? (float)$priceRange[1] : null;

                    if ($minPrice !== null && $maxPrice !== null) {
                        $query->whereBetween('price', [$minPrice, $maxPrice]);
                    } elseif ($minPrice !== null) {
                        $query->where('price', '>=', $minPrice);
                    } elseif ($maxPrice !== null) {
                        $query->where('price', '<=', $maxPrice);
                    }
                }

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

        return $query->paginate(15, $page);
    }
}
