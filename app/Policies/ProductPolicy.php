<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;


class ProductPolicy
{
    public function read(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Product $product)
    {
        return $product->user_id === $user->id;
    }

    public function delete(User $user, Product $product)
    {
        return $product->user_id === $user->id;
    }
}
