<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BanResource extends JsonResource
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
            'user_id' => $this->user_id,
            'expiry_time' => $this->expiry_time,
            'is_permanent_ban' => $this->is_permanent_ban,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'complaint_id' => new ComplaintResource($this->complaint),
        ];
    }
}
