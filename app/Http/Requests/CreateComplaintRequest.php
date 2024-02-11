<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComplaintRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string'],
            'reason' => ['required', 'string'],
            'complainant_user_id' => ['nullable', 'integer'],
            'reported_user_id' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'type' => ['required', 'string'],
        ];
    }
}
