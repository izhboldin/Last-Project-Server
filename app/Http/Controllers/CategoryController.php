<?php

namespace App\Http\Controllers;

use App\Exceptions\ListCategoryException;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * It's our dependency injection - service of categories
     *
     * @param CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * List of categories
     *
     * @return string
     */
    public function index()
    {
        try {
            $message = $this->categoryService->getMessage();
        } catch (ListCategoryException $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ], 400);
        }

        return $message;
    }


}
