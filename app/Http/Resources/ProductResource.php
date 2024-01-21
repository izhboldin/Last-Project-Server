<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'request' => $this->resource
            // 'title' => $this->title,
            // 'description' => $this->description,
            // 'price' => $this->price,
            // 'category_id' => $this->category_id,
            // 'user_id' => $this->user_id,
            // 'updated_at' => $this->updated_at,
            // 'created_at' => $this->created_at,
            // 'user' => new UserResource($this->user),
            // 'category' => new CategoryResource($this->category),
        ];
    }
}
