<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    /**
     * Create a new policy instance.
     */
    public function index(User $user)
    {
        return true;
    }

    public function getMessages(User $user, Chat $chat)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function getOrCreate(User $user)
    {
        return true;
    }
}
