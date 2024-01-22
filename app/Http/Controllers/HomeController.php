<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $quantityUsers = User::query()->count();
        $quantityProduct = Product::query()->count();
        $quantityCategory = Category::query()->count();

        return view('home', compact('quantityUsers', 'quantityProduct', 'quantityCategory'));
    }
}
