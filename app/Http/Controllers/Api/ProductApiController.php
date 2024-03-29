<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\CreateProductException;
use App\Exceptions\DeleteProductException;
use App\Exceptions\IndexProductException;
use App\Exceptions\UpdateProductException;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteImagesRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\GetAllProductResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Services\ImageService;
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

    private $imageService;

    public function __construct(ProductService $productService, ImageService $imageService)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
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

        return GetAllProductResource::collection($products);
    }

    public function get(string $id)
    {
        $product = Product::with('options.parameter', 'category', 'user')->findOrNew($id);

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

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        // return $request;

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
        return $product;
        // return new ProductResource($product);
    }

    public function delete(Product $product)
    {
        $this->authorize('delete', $product);

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

    public function uploadImages(ImageRequest $request, Product $product)
    {

        $data = $request->validated();

        $images = $this->imageService->upload($product, $data);

        return ImageResource::collection($images);
    }

    public function updateImage(ImageRequest $request, Product $product, Image $image)
    {
        $data = $request->validated();
        $image->delete();
        $images = $this->imageService->upload($product, $data);

        return ImageResource::collection($images);
    }

    public function deleteImage(Image $image)
    {
        $image->delete();
        return new ImageResource($image);
    }
}
