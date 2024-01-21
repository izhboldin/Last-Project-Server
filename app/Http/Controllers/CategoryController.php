<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateCategoryException;
use App\Exceptions\DeleteCategoryException;
use App\Exceptions\UpdateCategoryException;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
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

    public function view(Request $request)
    {
        $this->authorize('read', Category::class);

        //TODO IN NORMAL WAY
        $category = Category::find($request->get('category_id'));
        $categories = Category::myfuckingscope()->get();

        return view('category.view', compact('categories', 'category'));
    }

    /**
     * List of categories
     *
     * @return string
     */
    public function index()
    {
        $this->authorize('read', Category::class);

        $categories = Category::all();
        return view('category.category', compact('categories'));
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

        try {
            $data = $request->validated();
            $this->categoryService->create($data);
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

        try {
            $data = $request->validated();
            $this->categoryService->update($data, $category);
        } catch (UpdateCategoryException $e) {
            // TODO!!! implement in this way -> return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
}
