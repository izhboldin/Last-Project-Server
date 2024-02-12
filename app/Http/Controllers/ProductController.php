<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
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

    public function index(Request $request)
    {
        $this->authorize('read', Product::class);

        $products = Product::with('options.parameter');
        $str = $request->get('str');

        if ($str !== null) {
            $products->searchByStatus($str);
        }
        $products = $products->get();

        return view('product.index', compact('products'));
    }

    public function get(Product $product)
    {
        $product = $product->with('options.parameter', 'category')->first();
        return view('product.details', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function editStatus(Request $request, Product $product)
    {
        $status = ['status' =>  $request->get('status'),];
        $product->update($status);

        return redirect()->route('products.index');
    }

    public function update(ProductRequest $request, Product $product){
        $data = $request->validated();
        $product->update($data);

        return redirect()->route('products.index');
    }
}
