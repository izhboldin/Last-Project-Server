<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateCategoryException;
use App\Exceptions\DeleteCategoryException;
use App\Exceptions\UpdateCategoryException;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * It's our dependency injection - service of categories
     *
     * @param CategoryService
     */

    private $categoryService;
    private $imageService;

    public function __construct(CategoryService $categoryService, ImageService $imageService)
    {
        $this->categoryService = $categoryService;
        $this->imageService = $imageService;
    }

    private function getCategoryData($categories, $id = null)
    {
        $allQuantityCategory = Category::count();
        $quantityCategory = $categories->count();
        $categories = CategoryResource::collection($categories);

        return compact('categories', 'id', 'allQuantityCategory', 'quantityCategory');
    }

    public function myView(string $id)
    {
        $this->authorize('read', Category::class);

        $categories = Category::where('parent_category_id', '=', $id)->get();

        return view('category.index', $this->getCategoryData($categories, $id));
    }

    public function index()
    {
        $this->authorize('read', Category::class);
        $categories = Category::whereNull('parent_category_id')->get();

        return view('category.index', $this->getCategoryData($categories));
    }

    public function create()
    {
        $this->authorize('create', Category::class);

        $categories = Category::all();

        return view('category.create', compact('categories'));
    }

    public function store(CreateCategoryRequest $request)
    {
        $this->authorize('create', Category::class);

        $data = $request->validated();

        try {
            $category = $this->categoryService->create($data);
            if (isset($data['images'])) {
                $this->imageService->upload($category, $data, true, true);
            }
        } catch (CreateCategoryException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        $this->authorize('read', $category);

        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $this->authorize('read', $category);
        $categories = Category::all();

        return view('category.edit', compact('category', 'categories'));
    }

    public function update(CreateCategoryRequest $request, Category $category)
    {

        $this->authorize('update', $category);
        $data = $request->validated();

        try {
            $this->categoryService->update($data, $category);
            $this->imageService->upload($category, $data, true, true);
        } catch (UpdateCategoryException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return redirect()->route('categories.index');
    }

    public function delete(Category $category)
    {
        $this->authorize('delete', $category);

        try {
            $this->categoryService->delete($category);
        } catch (DeleteCategoryException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return redirect()->route('categories.index');
    }

    public function search(SearchRequest $request)
    {
        $search = $request->get('search');
        if (!$search) {
            return redirect()->route('category.index');
        }
        $categories = Category::where('name', 'like', '%' . $search . '%')->get();
        // if(!$categories){
        //     return view('category.index', $categories);
        // }
        return view('category.index', $this->getCategoryData($categories));
    }

    public function back(Category $category)
    {
        $parentId = $category['parent_category_id'];
        if ($parentId == null) {
            return redirect()->route('categories.index');
        }
        return redirect()->route('categories.more', $parentId);
    }
}
