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
        'size' => \Roman\Store\Models\Sizes::class,
        'category' => \Roman\Store\Models\Categories::class
    ];

    public function scopeListFrontEnd($query, $options = [])
    {
        extract(array_merge([
            'size' => '',
            'category' => '',
            'price' => '',
        ], $options));

        $query->with('size');
        $query->with('category');

        if ($size || $category || $price) {
            $query->where(function ($query) use ($size, $category, $price) {
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

                if ($size and !in_array('all-sizes', $size)) {
                    $query->where(function ($query) use ($size) {
                        foreach ($size as $key => $value) {
                            $query->orWhereHas('size', function ($query) use ($value) {
                                $query->where('slug', $value);
                            });
                        }
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
