<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     *
     * @return view.blade
     */
    public function index()
    {
        $products = Product::all();
        return view('product.products', compact('products'));
    }

    /** redirect to create page
     *
     * @return view.blade
     */
    public function create()
    {
        return view('product.create',);
    }

    /** Store a newly created product in the database.
     *
     * @param \App\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        // следущую строку, сделать методом сервиса, и предавать туда $data и $user, ааааа, и обернуть в трайкечь
        Product::create($data);

        return redirect()->route('product.index');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        return redirect()->route('product.index');
    }

    /** delete product
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
