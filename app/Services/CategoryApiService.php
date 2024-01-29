<?php

namespace App\Services;

use App\Exceptions\ListCategoryException;
use App\Models\Category;
use Exception;
use Illuminate\Support\Carbon;

class CategoryApiService
{
    public function index()
    {
        return Category::whereNull('parent_category_id')->with('children')->get();
    }

    public function get(string $id)
    {
        $category = Category::find($id);

        $parentCategories = $category->getParentCategories();

        $category = Category::where('id', '=', $id)->with('parameters.options')->first();

        foreach ($parentCategories as $item) {
            foreach ($item->parameters as $parameter) {
                $category->parameters = $category->parameters->add($parameter);
            }
        }
        return $category;
    }
}
