<?php

namespace App\Services;

use App\Exceptions\ListCategoryException;
use App\Models\Chat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChatService
{

    public function index(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status');

        $chat = Chat::query();

        if ($status == 'seller') {
            $chat->where('seller_id', $user->id);
        } else {
            $chat->where('buyer_id', $user->id);
        }

        return $chat->get();
    }

    public function getChatsOrCreate(Request $request)
    {
        $user = $request->user();
        $sellerId = $request->get('sellerId');

        $chat = Chat::where('buyer_id', $user->id)->where('seller_id', $sellerId)->first();

        if (!$chat) {
            $chat = Chat::create([
                'buyer_id' => $user->id,
                'seller_id' => $sellerId,
            ]);
        }

        return $chat;
    }
}
