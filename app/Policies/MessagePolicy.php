<?php

namespace App\Policies;

use App\Models\User;

class MessagePolicy
{
    /**
     * Create a new policy instance.
     */
    public function index(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

}
