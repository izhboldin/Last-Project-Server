<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\IndexMessageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageApiController extends Controller
{
    /**
     * Injected product service
     *
     * @param MessageService
     */
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(Chat $chat, Request $request)
    {
        try {
            $messages = $this->messageService->index($chat, $request);
        } catch (IndexMessageException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return MessageResource::collection($messages);
    }

    public function create(Chat $chat, CreateMessageRequest $request,)
    {
        try {
            $message = $this->messageService->create($chat, $request);
        } catch (IndexMessageException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }
        return new MessageResource($message);

    }
}
