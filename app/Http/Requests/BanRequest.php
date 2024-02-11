<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'complaint_id' => ['required', 'integer'],
            // 'user_id' => ['required', 'integer'],
            'is_permanent_ban' => ['nullable', 'boolean'],
            'expiry_time' => ['nullable', 'date'],
        ];
    }
}
