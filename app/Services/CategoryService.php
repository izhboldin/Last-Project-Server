<?php

namespace App\Services;

use App\Exceptions\ListCategoryException;
use App\Models\Category;
use Exception;
use Illuminate\Support\Carbon;

class CategoryService
{

    public function create($data)
    {
       return Category::create($data);
    }

    public function update($data, Category $category)
    {
       return $category->update($data);
    }

    public function delete(Category $category)
    {
        $category->delete();
    }
}
