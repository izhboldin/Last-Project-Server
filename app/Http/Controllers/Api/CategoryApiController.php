<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryApiResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function getIndex()
    {
        $categories = Category::whereNull('parent_category_id')->get();
        return $categories;
    }

    public function get(string $id)
    {
        $categories = Category::where('parent_category_id', '=', $id)->with('parameters.options')->get();

        return $categories;
    }

    public function back(string $parentId)
    {
        $category = Category::where('id', $parentId)->first();
        if ($category) {
            $newParentCategoryId = $category['parent_category_id'];
            return $newParentCategoryId;
        } else {
            return redirect()->route('fallback_route');
        }
    }
}
