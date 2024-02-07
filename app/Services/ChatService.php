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
        $buyerId = $request->get('buyerId');
        $sellerId = $request->get('sellerId');

        $chat = Chat::where('buyer_id', $buyerId)->where('seller_id', $sellerId)->first();

        if(!$chat){
            $chat = Chat::create([
                'buyer_id' => $buyerId,
                'seller_id' => $sellerId,
            ]);
        }

        return $chat;
    }
}
