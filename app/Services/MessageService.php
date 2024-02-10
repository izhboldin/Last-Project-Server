<?php

namespace App\Services;

use App\Events\MessageSent;
use App\Events\MessageWasCreated;
use App\Exceptions\ListCategoryException;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MessageService
{

    public function index(Chat $chat, Request $request)
    {
        return $chat->messages()->with('user')->get();
    }

    public function create(Chat $chat, Request $request)
    {
        $user = $request->user();
        $message = Message::create([
            'chat_id' => $chat->id,
            'user_id' => $user->id,
            'message' => $request->get('message'),
        ]);


        // event(new MessageWasCreated($message));
        broadcast(new MessageWasCreated($message));

        // event(new MessageSent($user, $message));
        broadcast(new MessageSent($user, $message));

        return $message;
    }
}
