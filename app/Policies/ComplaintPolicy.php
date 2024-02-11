<?php

namespace App\Policies;

use App\Models\User;

class ComplaintPolicy
{

    public function index(User $user)
    {
        return true;
    }

    public function get(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }
}
