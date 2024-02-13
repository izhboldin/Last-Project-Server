<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_category_id' => ['nullable', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'is_main_category' => ['required', 'boolean'],
            'images' => ['array'],
            'images.*.file' => ['required', 'image'],
        ];
    }
}
