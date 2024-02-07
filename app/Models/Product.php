<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_options', 'product_id', 'option_id');
    }

    public function scopeSearchByStatus($query, $str)
    {
        $query->where('status', '=', $str);
    }

    public function scopeFilterByCategory($query, $categoryId)
    {
        $query->where('category_id', '=', $categoryId);
    }

    public function scopeFilterByTitle($query, $search)
    {
        $query->where('title', 'like', '%' . $search . '%');
        $query->orderBy('title', 'asc');
    }

    public function scopeFilterByOptions($queries, $options)
    {
        $queries->whereHas('options', function ($subQuery) use ($options) {
            $subQuery->whereIn('id', $options);
        }, '=', count($options));
    }


    public function scopeFilterByPrice($query, $minPrice, $maxPrice)
    {
        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $query->where('price', '>', $minPrice);
        } elseif ($maxPrice !== null) {
            $query->where('price', '<', $maxPrice);
        }
    }

    public function scopeSortByDate($query, $date)
    {
        $query->orderBy('created_at', $date);
    }

    public function scopeSortByPrice($query, $price)
    {
        $query->orderBy('price', $price);
    }
}
