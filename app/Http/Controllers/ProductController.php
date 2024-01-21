<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateProductException;
use App\Exceptions\DeleteProductException;
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

class ProductController extends Controller
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


    public function index()
    {
        $this->authorize('read', Product::class);

        $products = Product::all();

        return ProductResource::collection($products);
    }

    public function get(Product $product)
    {
        $this->authorize('read', Product::class);

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
                ],400);
        }

        return new ProductResource($product);
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
                ],400);
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
                ],400);
        }

        return new ProductResource($product);
    }
}
