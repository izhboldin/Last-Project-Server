<?php

use App\Models\Chat;
use App\Models\Message;
use App\Broadcasting\ChatChannel;
use App\Broadcasting\PdfChannel;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('messages.{userId}', function (User $user, $userId) {
    return true;
});
Broadcast::channel('chat', ChatChannel::class);

Broadcast::channel('pdf-create.{userId}', PdfChannel::class);
