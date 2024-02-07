<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CreateChatException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatApiController extends Controller
{

    /**
     * Injected product service
     *
     * @param ChatService
     */
    private $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function getChatsOrCreate (Request $request)
    {
        $this->authorize('getOrCreate', Chat::class);

        try {
            $chat = $this->chatService->index($request);
        } catch (CreateChatException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return new ChatResource($chat);
    }
}
