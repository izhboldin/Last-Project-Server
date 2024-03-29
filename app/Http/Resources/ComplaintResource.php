<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'reason' => $this->reason,
            'type' => $this->type,
            'status' => $this->status,
            // 'complainant_user_id' => new UserResource($this->complainantUser),
            // 'reported_user_id' => new UserResource($this->reportedUser),
            'created_at' => $this->created_at,
        ];
    }
}
