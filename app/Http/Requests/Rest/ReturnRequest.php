<?php

namespace App\Http\Requests\Rest;

use Illuminate\Foundation\Http\FormRequest;

class ReturnRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'return_date' => 'required|date',
        ];
    }

    public function messages(): array{
        return [
            'return_date.required' => 'Return date is required.',
            'return_date.date' => 'Return date must be a valid date.',
        ];
    }
}
