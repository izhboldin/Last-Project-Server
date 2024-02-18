<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $quantityUsers = User::query()->where('role', 'user')->count();
        $quantityUsersInThisMonth = User::query()->where('role', 'user')->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityAdmin = User::query()->where('role', 'admin')->count();
        $quantityAdminInThisMonth = User::query()->where('role', 'admin')->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityModer = User::query()->where('role', 'moderator')->count();
        $quantityModerInThisMonth = User::query()->where('role', 'moderator')->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityProduct = Product::query()->count();
        $quantityProductInThisMonth = Product::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityCategory = Category::query()->count();
        $quantityCategoryInThisMonth = Category::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityCategory = Category::query()->count();
        $quantityCategoryInThisMonth = Category::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityBan = Ban::query()->count();
        $quantityBanInThisMonth = Ban::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();

        return view('home', compact(
            'quantityUsers',
            'quantityUsersInThisMonth',
            'quantityAdmin',
            'quantityAdminInThisMonth',
            'quantityModer',
            'quantityModerInThisMonth',
            'quantityProduct',
            'quantityProductInThisMonth',
            'quantityCategory',
            'quantityCategoryInThisMonth',
            'quantityBan',
            'quantityBanInThisMonth',
        ));
    }
}
