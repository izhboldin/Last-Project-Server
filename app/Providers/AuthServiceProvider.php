<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Category;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\ChatPolicy;
use App\Policies\MessagePolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        User::class => UserPolicy::class,
        Chat::class => ChatPolicy::class,
        Message::class => MessagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

    }
}
