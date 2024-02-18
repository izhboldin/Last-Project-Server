<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CreateChatException;
use App\Exceptions\IndexChatException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Services\ChatService;
use Exception;
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

    public function index(Request $request)
    {
        $this->authorize('index', Chat::class);
        try {
            $chats = $this->chatService->index($request);
        } catch (IndexChatException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return ChatResource::collection($chats);
    }

    public function getChatsOrCreate(Request $request)
    {
        $this->authorize('index', Chat::class);

        try {
            $chat = $this->chatService->getChatsOrCreate($request);
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
