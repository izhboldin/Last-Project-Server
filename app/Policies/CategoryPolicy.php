<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function read(User $user)
    {
        return in_array($user->role, ['moderator', 'admin']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['moderator', 'admin']);
    }

    public function update(User $user, Category $category)
    {
        return in_array($user->role, ['moderator', 'admin']);
    }

    public function delete(User $user, Category $category)
    {
        return in_array($user->role, ['moderator', 'admin']);
    }
}
