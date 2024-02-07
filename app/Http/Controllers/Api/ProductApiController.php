<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\CreateProductException;
use App\Exceptions\DeleteProductException;
use App\Exceptions\IndexProductException;
use App\Exceptions\UpdateProductException;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\search;

class ProductApiController extends Controller
{
    /**
     * Injected product service
     *
     * @param ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {

        try {
            $products = $this->productService->index($request);
        } catch (IndexProductException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return $products;
    }

    public function indexYourProduct (Request $request)
    {
        $this->authorize('read', Product::class);
        try {
            $products = $this->productService->indexYourProduct($request);
        } catch (Exception $e) {
            return $e->getMessage();
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return $products;
    }

    public function get(string $id)
    {
        // $this->authorize('read', Product::class);

        $product = Product::with('options.parameter', 'category', 'user')->find($id);

        return new ProductResource($product);
    }

    public function create(CreateProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();
        $user = $request->user();
        try {
            $product = $this->productService->create($user, $data);
        } catch (CreateProductException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return $product;
        // return new ProductResource($product);
    }

    public function update(CreateProductRequest $request, Product $product)
    {
        $this->authorize('update', Product::class);

        $data = $request->validated();
        try {
            $this->productService->update($product, $data);
        } catch (UpdateProductException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return new ProductResource($product);
    }

    public function delete(Product $product)
    {
        $this->authorize('delete', Product::class);

        try {
            $this->productService->delete($product);
        } catch (DeleteProductException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return new ProductResource($product);
    }
}
