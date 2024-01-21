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
            'parent_category_id' => $this->parent_category_id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'is_main_category' => $this->is_main_category,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
