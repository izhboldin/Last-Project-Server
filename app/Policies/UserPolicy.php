<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Model $model)
    {
        return $user->role === 'admin';
    }
    public function updateImage(User $user,)
    {
        return true;
    }
}
