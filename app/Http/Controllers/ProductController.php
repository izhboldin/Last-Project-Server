<?php

namespace App\Http\Controllers;

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

    public function edit(Request $request, Product $product)
    {
        $status =['status' =>  $request->get('status'),];
        // dd($status);
        $product->update($status);
        return redirect()->route('products.index');
    }
}
