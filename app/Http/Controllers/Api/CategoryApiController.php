<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CategoryApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ChooseCategoryResource;
use App\Http\Resources\GetAllCategoryResource;
use App\Models\Category;
use App\Services\CategoryApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{

    private $categoryApiService;

    public function __construct(CategoryApiService $categoryApiService)
    {
        $this->categoryApiService = $categoryApiService;
    }

    public function index()
    {
        try {
            $categories = $this->categoryApiService->index();
        } catch (CategoryApiException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return GetAllCategoryResource::collection($categories)->flatten();
    }

    public function get(string $id)
    {

        try {
            $category = $this->categoryApiService->get($id);
        } catch (CategoryApiException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }


        return new ChooseCategoryResource($category);
    }
}
