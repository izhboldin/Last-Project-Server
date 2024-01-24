<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    private function verificationUser($user)
    {
        return in_array($user->role, ['moderator', 'admin']);
    }

    public function read(User $user)
    {
        return $this->verificationUser($user);
    }

    public function create(User $user)
    {
        return $this->verificationUser($user);
    }

    public function update(User $user, Category $category)
    {
        return $this->verificationUser($user);
    }

    public function delete(User $user, Category $category)
    {
        return $this->verificationUser($user);
    }
}
