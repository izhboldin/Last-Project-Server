<?php

namespace App\Services;

use App\Events\ProductWasCreated;
use App\Events\ProductWasDeleted;
use App\Events\ProductWasUpdated;
use App\Exceptions\CreateProductException;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function index(Request $request)
    {
        $user = $request->user();
        $products = Product::with('options.parameter', 'category');

        $str = $request->get('str');

        $categoryId = $request->get('categoryId');
        $search = $request->get('search');
        $options = $request->get('options');
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');

        $date = $request->get('date');
        $price = $request->get('price');


        if ($str !== null) {
            $products->where('user_id', '=', $user->id)->searchByStatus($str);
        }
        if ($categoryId !== null) {
            $products->filterByCategory($categoryId);
        }
        if ($search !== null) {
            $products->filterByTitle($search);
        }
        if ($options !== null) {
            !(is_array($options)) ? $options = json_decode("[" . $options . "]") : '';

            $products->filterByOptions($options);
        }

        if ($minPrice !== null || $maxPrice !== null) {
            $products->filterByPrice($minPrice, $maxPrice);
        }

        if ($date !== null) {
            $products->sortByDate($date);
        }
        if ($price !== null) {
            $products->sortByPrice($price);
        }

        return  $products->get();
    }
    public function create(User $user, $data)
    {
        $productData = $this->makeProductData($data);
        $category = Category::findOrFail($data['category_id']);
        $options = $this->makeOptions($data);

        if ($category->children()->exists()) {
            throw new CreateProductException('You cannot associate parent category!');
        }

        $product = DB::transaction(function () use ($user, $productData, $category, $options) {
            $product = new Product($productData);
            $product->user()->associate($user);
            $product->category()->associate($category);
            $product->save();
            $product->options()->sync($options);
            return $product;
        });

        event(new ProductWasCreated($product));

        return $product;
    }

    public function  update(Product $product, $data)
    {
        $productData = $this->makeProductData($data);
        $options = $this->makeOptions($data);
        DB::transaction(function () use ($data, $productData, $options, $product) {
            $product->update($productData);

            if (isset($data['options'])) {
                $product->options()->sync($options);
            }
        });

        event(new ProductWasUpdated($product));
    }

    public function delete(Product $product)
    {
        $product->delete();
        event(new ProductWasDeleted($product));
    }

    protected function makeProductData($data)
    {
        return Arr::except($data, ['category_id', 'options']);
    }

    protected function makeOptions($data)
    {
        return collect(Arr::get($data, 'options', []));
    }
}
