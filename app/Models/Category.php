<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'is_main_category' => 'boolean'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id')->with('children');
    }
    public function childrenId()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id')->with('childrenId');
    }

    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // public function getAllDescendantsProducts()
    // {
    //     $descendants = $this->descendants()->pluck('id');
    //     return Product::whereIn('category_id', $descendants)->orWhere('category_id', $this->id)->get();
    // }

    public function getParentCategories($parentCategories = [])
    {
        $parentCategory = $this;

        while ($parentCategory->parent_category_id) {
            $parentCategory = Category::with('parameters.options')->find($parentCategory->parent_category_id);
            $parentCategories[] = $parentCategory;
        }

        // Возвращаем массив родительских категорий
        return $parentCategories;
    }
}
