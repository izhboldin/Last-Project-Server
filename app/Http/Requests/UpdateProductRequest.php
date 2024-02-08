<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
            'category_id' => ['nullable', 'integer'],
            'options' => ['nullable', 'array'],
            'state' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }
}
