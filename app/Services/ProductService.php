<?php

namespace App\Services;

use App\Events\ProductWasCreated;
use App\Events\ProductWasDeleted;
use App\Events\ProductWasUpdated;
use App\Exceptions\CreateProductException;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductService
{
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
