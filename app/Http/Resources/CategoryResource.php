<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parent_category_id' => $this->parent_category_id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => new ImageResource($this->image),
            'is_main_category' => $this->is_main_category,
        ];
    }
}
